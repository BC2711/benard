<?php

// app/Http/Controllers/Admin/FooterController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSection;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index()
    {
        $footer = FooterSection::firstOrCreate([]);
        return view('admin.footer.edit', compact('footer'));
    }

    public function update(Request $request, FooterSection $footer)
    {
        $data = $request->validate([
            'brand_name' => 'required|string',
            'brand_tagline' => 'required|string',
            'brand_description' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address_line1' => 'required|string',
            'address_line2' => 'required|string',
            'facebook' => 'required|url',
            'twitter' => 'required|url',
            'linkedin' => 'required|url',
            'instagram' => 'required|url',
            'newsletter_heading' => 'required|string',
            'newsletter_description' => 'required|string',
            'copyright_text' => 'required|string',
            'footer_note' => 'required|string',
        ]);

        // Quick Links
        $quick = [];
        $qTexts = $request->input('quick_text', []);
        foreach ($qTexts as $i => $text) {
            if ($text && $request->input("quick_url_{$i}")) {
                $quick[] = ['text' => $text, 'url' => $request->input("quick_url_{$i}")];
            }
        }
        $data['quick_links'] = $quick;

        // Resources
        $res = [];
        $rTexts = $request->input('resource_text', []);
        foreach ($rTexts as $i => $text) {
            if ($text && $request->input("resource_url_{$i}")) {
                $res[] = ['text' => $text, 'url' => $request->input("resource_url_{$i}")];
            }
        }
        $data['resources'] = $res;

        // Trust Badges
        $trust = [];
        $tTexts = $request->input('trust_text', []);
        foreach ($tTexts as $i => $text) {
            if ($text && $request->input("trust_icon_{$i}")) {
                $trust[] = ['icon' => $request->input("trust_icon_{$i}"), 'text' => $text];
            }
        }
        $data['trust_badges'] = $trust;

        // Legal Links
        $legal = [];
        $lTexts = $request->input('legal_text', []);
        foreach ($lTexts as $i => $text) {
            if ($text && $request->input("legal_url_{$i}")) {
                $legal[] = ['text' => $text, 'url' => $request->input("legal_url_{$i}")];
            }
        }
        $data['legal_links'] = $legal;

        $footer->update($data);

        return back()->with('success', 'Footer updated!');
    }
}
