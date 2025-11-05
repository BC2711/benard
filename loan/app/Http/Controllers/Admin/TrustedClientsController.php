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
        return view('components.management.clients.edit', compact('section'));
    }

    public function update(Request $request, $id)
    {
        $section = TrustedClientsSection::findOrFail($id);

        $data = $request->validate([
            'heading' => 'required|string',
            'description' => 'required|string',
            'cta_heading' => 'required|string',
            'cta_description' => 'required|string',
            'cta_primary_text' => 'required|string',
            'cta_primary_link' => 'required|string',
            'cta_primary_icon' => 'required|string',
            'cta_secondary_text' => 'required|string',
            'cta_secondary_link' => 'required|string',
            'cta_secondary_icon' => 'required|string',
        ]);

        // Industry Badges
        $badges = [];
        for ($i = 0; $i <= 3; $i++) { // Based on your form data (0-3)
            $badgeIcon = $request->input("badge_icon_{$i}");
            $badgeText = $request->input("badge_text_{$i}");

            if ($badgeIcon && $badgeText) {
                $badges[] = [
                    'icon' => $badgeIcon,
                    'text' => $badgeText,
                ];
            }
        }
        $data['industry_badges'] = $badges;

        // Clients
        $clients = [];
        for ($i = 0; $i <= 5; $i++) { // Based on your form data (0-5)
            $name = $request->input("client_name_{$i}");

            if ($name) {
                $type = $request->input("client_type_{$i}", '');
                $description = $request->input("client_description_{$i}", '');
                $tag1 = $request->input("client_tag1_{$i}");
                $tag2 = $request->input("client_tag2_{$i}");

                $clients[] = [
                    'initials' => strtoupper(substr($name, 0, 1) . substr($type, 0, 1)),
                    'name' => $name,
                    'type' => $type,
                    'description' => $description,
                    'tags' => array_filter([$tag1, $tag2]),
                ];
            }
        }
        $data['clients'] = $clients;

        // Success Highlights
        $highlights = [];
        for ($i = 0; $i <= 2; $i++) { // Based on your form data (0-2)
            $client = $request->input("highlight_client_{$i}");

            if ($client) {
                $highlights[] = [
                    'amount' => $request->input("highlight_amount_{$i}", ''),
                    'client' => $client,
                    'type' => $request->input("highlight_type_{$i}", ''),
                    'result' => $request->input("highlight_result_{$i}", ''),
                    'metric' => $request->input("highlight_metric_{$i}", ''),
                    'timeline' => $request->input("highlight_timeline_{$i}", ''),
                ];
            }
        }
        $data['highlights'] = $highlights;

        // Testimonials
        $testimonials = [];
        for ($i = 0; $i <= 1; $i++) { // Based on your form data (0-1)
            $name = $request->input("testimonial_name_{$i}");

            if ($name) {
                $role = $request->input("testimonial_role_{$i}", '');
                $quote = $request->input("testimonial_quote_{$i}", '');

                $testimonials[] = [
                    'initials' => strtoupper(substr($name, 0, 1) . substr($role, 0, 1)),
                    'name' => $name,
                    'role' => $role,
                    'quote' => $quote,
                ];
            }
        }
        $data['testimonials'] = $testimonials;

        // Trust Indicators
        $trust = [];
        for ($i = 0; $i <= 2; $i++) { // Based on your form data (0-2)
            $trustIcon = $request->input("trust_icon_{$i}");
            $trustText = $request->input("trust_text_{$i}");

            if ($trustIcon && $trustText) {
                $trust[] = [
                    'icon' => $trustIcon,
                    'text' => $trustText,
                ];
            }
        }
        $data['trust_indicators'] = $trust;

        $section->update($data);

        return back()->with('success', 'Trusted Clients section updated successfully!');
    }
}
