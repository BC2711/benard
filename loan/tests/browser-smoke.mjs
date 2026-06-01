import { spawn } from 'node:child_process';
import { fileURLToPath } from 'node:url';
import path from 'node:path';

const baseUrl = process.env.QA_BASE_URL ?? 'http://127.0.0.1:8010';
const chromePath = process.env.CHROME_PATH
    ?? 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';
const profilePath = path.resolve(path.dirname(fileURLToPath(import.meta.url)), '..', 'storage', 'qa-chrome');
const debuggingPort = 9223;
const pages = [
    '/',
    '/consultation',
    '/calculator',
    '/service-details',
    '/testimonial-reviews',
    '/success-stories',
    '/terms',
    '/privacy',
    '/register',
    '/management/login',
];
const viewports = [
    { name: 'desktop', width: 1440, height: 1200, mobile: false },
    { name: 'tablet', width: 768, height: 1024, mobile: false },
    { name: 'mobile', width: 390, height: 844, mobile: true },
];

const chrome = spawn(chromePath, [
    '--headless=new',
    '--disable-gpu',
    '--no-first-run',
    '--no-default-browser-check',
    `--remote-debugging-port=${debuggingPort}`,
    `--user-data-dir=${profilePath}`,
    'about:blank',
], { stdio: 'ignore' });

const sleep = (ms) => new Promise((resolve) => setTimeout(resolve, ms));

async function connect() {
    for (let attempt = 0; attempt < 50; attempt++) {
        try {
            const response = await fetch(`http://127.0.0.1:${debuggingPort}/json/version`);
            if (response.ok) {
                return new CdpClient((await response.json()).webSocketDebuggerUrl);
            }
        } catch {
            // Chrome is still starting.
        }
        await sleep(100);
    }

    throw new Error('Chrome DevTools endpoint did not start.');
}

class CdpClient {
    constructor(url) {
        this.nextId = 1;
        this.pending = new Map();
        this.listeners = new Map();
        this.socket = new WebSocket(url);
        this.ready = new Promise((resolve, reject) => {
            this.socket.addEventListener('open', resolve);
            this.socket.addEventListener('error', reject);
        });
        this.socket.addEventListener('message', ({ data }) => {
            const message = JSON.parse(data);
            if (message.id) {
                const pending = this.pending.get(message.id);
                if (!pending) return;
                this.pending.delete(message.id);
                message.error ? pending.reject(new Error(message.error.message)) : pending.resolve(message.result);
                return;
            }

            for (const listener of this.listeners.get(message.method) ?? []) {
                listener(message.params ?? {}, message.sessionId);
            }
        });
    }

    async send(method, params = {}, sessionId) {
        await this.ready;
        const id = this.nextId++;
        this.socket.send(JSON.stringify({ id, method, params, sessionId }));
        return new Promise((resolve, reject) => this.pending.set(id, { resolve, reject }));
    }

    on(method, listener) {
        this.listeners.set(method, [...(this.listeners.get(method) ?? []), listener]);
    }

    close() {
        this.socket.close();
    }
}

async function evaluate(client, sessionId, expression) {
    const result = await client.send('Runtime.evaluate', {
        expression,
        returnByValue: true,
        awaitPromise: true,
    }, sessionId);

    return result.result.value;
}

let client;
let failed = false;

try {
    client = await connect();
    const { targetId } = await client.send('Target.createTarget', { url: 'about:blank' });
    const { sessionId } = await client.send('Target.attachToTarget', { targetId, flatten: true });
    const events = { errors: [], localFailures: [], externalFailures: [], documentStatus: null };

    client.on('Runtime.exceptionThrown', ({ exceptionDetails }, currentSessionId) => {
        if (currentSessionId !== sessionId) return;

        events.errors.push(
            exceptionDetails.exception?.description
                ?? `${exceptionDetails.text} at ${exceptionDetails.url}:${exceptionDetails.lineNumber + 1}`,
        );
    });
    client.on('Log.entryAdded', ({ entry }, currentSessionId) => {
        if (currentSessionId === sessionId && entry.level === 'error') events.errors.push(entry.text);
    });
    client.on('Network.loadingFailed', ({ errorText, type }, currentSessionId) => {
        if (currentSessionId === sessionId && type !== 'Document') events.externalFailures.push(errorText);
    });
    client.on('Network.responseReceived', ({ response, type }, currentSessionId) => {
        if (currentSessionId !== sessionId) return;
        if (type === 'Document') events.documentStatus = response.status;
        if (response.status < 400) return;

        const target = response.url.startsWith(baseUrl) ? events.localFailures : events.externalFailures;
        target.push(`${response.status} ${response.url}`);
    });

    await client.send('Runtime.enable', {}, sessionId);
    await client.send('Log.enable', {}, sessionId);
    await client.send('Network.enable', {}, sessionId);
    await client.send('Page.enable', {}, sessionId);

    for (const viewport of viewports) {
        await client.send('Emulation.setDeviceMetricsOverride', {
            width: viewport.width,
            height: viewport.height,
            deviceScaleFactor: 1,
            mobile: viewport.mobile,
        }, sessionId);

        for (const page of pages) {
            events.errors = [];
            events.localFailures = [];
            events.externalFailures = [];
            events.documentStatus = null;

            await client.send('Page.navigate', { url: `${baseUrl}${page}` }, sessionId);
            for (let attempt = 0; attempt < 40; attempt++) {
                if (await evaluate(client, sessionId, 'document.readyState') === 'complete') break;
                await sleep(100);
            }
            await sleep(350);

            const result = await evaluate(client, sessionId, `(() => ({
                title: document.title,
                metaDescription: document.querySelector('meta[name="description"]')?.content ?? '',
                canonical: document.querySelector('link[rel="canonical"]')?.href ?? '',
                horizontalOverflow: document.documentElement.scrollWidth > document.documentElement.clientWidth,
                brokenImages: [...document.images]
                    .filter((image) => image.complete && image.naturalWidth === 0)
                    .map((image) => image.src),
            }))()`);
            const issues = [
                ...(events.documentStatus !== 200 ? [`document status ${events.documentStatus}`] : []),
                ...(!result.title ? ['missing title'] : []),
                ...(!result.metaDescription ? ['missing meta description'] : []),
                ...(!result.canonical ? ['missing canonical URL'] : []),
                ...(result.horizontalOverflow ? ['horizontal overflow'] : []),
                ...result.brokenImages.map((image) => `broken image ${image}`),
                ...events.localFailures,
                ...events.errors,
            ];
            if (issues.length) failed = true;

            console.log(JSON.stringify({
                viewport: viewport.name,
                page,
                status: issues.length ? 'failed' : 'passed',
                issues,
                externalWarnings: [...new Set(events.externalFailures)],
            }));
        }
    }
} finally {
    client?.close();
    chrome.kill();
}

process.exitCode = failed ? 1 : 0;
