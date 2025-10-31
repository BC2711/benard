<?php

// app/Http/Controllers/Admin/TrustedClientsController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrustedClientsSection;
use Illuminate\Http\Request;

class TrustedClientsController extends Controller
{
    public function index()
    {
        $section = TrustedClientsSection::firstOrCreate([]);
        return view('admin.trusted-clients.edit', compact('section'));
    }

    public function update(Request $request, TrustedClientsSection $section)
    {
        $data = $request->validate([
            'heading' => 'required|string',
            'description' => 'required|string',
            'cta_heading' => 'required|string',
            'cta_description' => 'required|string',
            'cta_primary_text' => 'required|string',
            'cta_primary_link' => 'required|url',
            'cta_primary_icon' => 'required|string',
            'cta_secondary_text' => 'required|string',
            'cta_secondary_link' => 'required|url',
            'cta_secondary_icon' => 'required|string',
        ]);

        // Industry Badges
        $badges = [];
        $badgeTexts = $request->input('badge_text', []);
        foreach ($badgeTexts as $i => $text) {
            if ($text && $request->input("badge_icon_{$i}")) {
                $badges[] = [
                    'icon' => $request->input("badge_icon_{$i}"),
                    'text' => $text,
                ];
            }
        }
        $data['industry_badges'] = $badges;

        // Clients
        $clients = [];
        $names = $request->input('client_name', []);
        foreach ($names as $i => $name) {
            if ($name) {
                $clients[] = [
                    'initials' => strtoupper(substr($name, 0, 1) . substr($request->input("client_type_{$i}"), 0, 1)),
                    'name' => $name,
                    'type' => $request->input("client_type_{$i}"),
                    'description' => $request->input("client_description_{$i}"),
                    'tags' => array_filter([$request->input("client_tag1_{$i}"), $request->input("client_tag2_{$i}")]),
                ];
            }
        }
        $data['clients'] = $clients;

        // Highlights
        $highlights = [];
        $highlightClients = $request->input('highlight_client', []);
        foreach ($highlightClients as $i => $client) {
            if ($client) {
                $highlights[] = [
                    'amount' => $request->input("highlight_amount_{$i}"),
                    'client' => $client,
                    'type' => $request->input("highlight_type_{$i}"),
                    'result' => $request->input("highlight_result_{$i}"),
                    'metric' => $request->input("highlight_metric_{$i}"),
                    'timeline' => $request->input("highlight_timeline_{$i}"),
                ];
            }
        }
        $data['highlights'] = $highlights;

        // Testimonials
        $testimonials = [];
        $testNames = $request->input('testimonial_name', []);
        foreach ($testNames as $i => $name) {
            if ($name) {
                $testimonials[] = [
                    'initials' => strtoupper(substr($name, 0, 1) . substr($request->input("testimonial_role_{$i}"), 0, 1)),
                    'name' => $name,
                    'role' => $request->input("testimonial_role_{$i}"),
                    'quote' => $request->input("testimonial_quote_{$i}"),
                ];
            }
        }
        $data['testimonials'] = $testimonials;

        // Trust Indicators
        $trust = [];
        $trustTexts = $request->input('trust_text', []);
        foreach ($trustTexts as $i => $text) {
            if ($text && $request->input("trust_icon_{$i}")) {
                $trust[] = [
                    'icon' => $request->input("trust_icon_{$i}"),
                    'text' => $text,
                ];
            }
        }
        $data['trust_indicators'] = $trust;

        $section->update($data);

        return back()->with('success', 'Trusted Clients section updated!');
    }
}
