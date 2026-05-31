@extends('layouts.admin.main')

@section('title', 'Email Settings')
@section('page-title', 'Email Settings')
@section('page-description', 'Configure SMTP delivery, administrator recipients, and account email security.')
@section('page-icon')<i class="fas fa-envelope-circle-check"></i>@endsection

@section('content')
    <div class="grid gap-6 xl:grid-cols-[1fr_22rem]">
        <form method="POST" action="{{ route('management.email-settings.update') }}" class="admin-card space-y-6 p-6">
            @csrf
            @method('PUT')
            <div class="grid gap-5 md:grid-cols-2">
                <label class="flex items-center gap-3 md:col-span-2">
                    <input type="checkbox" name="mail_enabled" value="1" @checked($settings['mail_enabled'])>
                    <span class="font-semibold">Enable outgoing email notifications</span>
                </label>
                <div>
                    <label class="admin-label">Mailer</label>
                    <select class="admin-input w-full" name="mailer">
                        @foreach (['smtp' => 'SMTP', 'log' => 'Log only', 'array' => 'Array (testing)', 'sendmail' => 'Sendmail'] as $value => $label)
                            <option value="{{ $value }}" @selected($settings['mailer'] === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="admin-label">Encryption</label>
                    <select class="admin-input w-full" name="scheme">
                        <option value="" @selected(blank($settings['scheme']))>Automatic STARTTLS</option>
                        <option value="smtp" @selected($settings['scheme'] === 'smtp')>SMTP</option>
                        <option value="smtps" @selected($settings['scheme'] === 'smtps')>SMTPS</option>
                    </select>
                </div>
                <div><label class="admin-label">SMTP host</label><input class="admin-input w-full" name="host" value="{{ old('host', $settings['host']) }}"></div>
                <div><label class="admin-label">SMTP port</label><input class="admin-input w-full" type="number" name="port" value="{{ old('port', $settings['port']) }}"></div>
                <div><label class="admin-label">SMTP username</label><input class="admin-input w-full" name="username" value="{{ old('username', $settings['username']) }}" autocomplete="off"></div>
                <div><label class="admin-label">SMTP password</label><input class="admin-input w-full" type="password" name="password" placeholder="Leave blank to keep the stored password" autocomplete="new-password"></div>
                <div><label class="admin-label">From address</label><input class="admin-input w-full" type="email" name="from_address" value="{{ old('from_address', $settings['from_address']) }}"></div>
                <div><label class="admin-label">From name</label><input class="admin-input w-full" name="from_name" value="{{ old('from_name', $settings['from_name']) }}"></div>
                <div class="md:col-span-2"><label class="admin-label">Administrator recipients</label><input class="admin-input w-full" name="admin_recipients" value="{{ old('admin_recipients', $settings['admin_recipients']) }}"><p class="mt-1 text-xs text-slate-500">Separate multiple addresses with commas.</p></div>
                <label class="flex items-center gap-3 md:col-span-2">
                    <input type="checkbox" name="two_factor_enabled" value="1" @checked($settings['two_factor_enabled'])>
                    <span class="font-semibold">Require email verification code during management login</span>
                </label>
            </div>
            <button class="admin-btn-primary" type="submit"><i class="fas fa-save"></i> Save settings</button>
        </form>

        <form method="POST" action="{{ route('management.email-settings.test') }}" class="admin-card h-fit space-y-4 p-6">
            @csrf
            <div>
                <h2 class="font-bold">Send test email</h2>
                <p class="mt-1 text-sm text-slate-500">The test is queued and recorded in Email Logs.</p>
            </div>
            <input class="admin-input w-full" type="email" name="email" placeholder="you@example.com" required>
            <button class="admin-btn-secondary w-full" type="submit"><i class="fas fa-paper-plane"></i> Queue test</button>
        </form>
    </div>
@endsection
