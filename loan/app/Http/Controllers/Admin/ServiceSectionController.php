<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceSection;
use Illuminate\Http\Request;

class ServiceSectionController extends Controller
{
    public function index()
    {
        $service = ServiceSection::firstOrCreate([]);
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, ServiceSection $service)
    {
        $data = $request->validate([
            'badge_text'        => 'required|string|max:255',
            'badge_icon'        => 'required|string',
            'heading'           => 'required|string',
            'highlighted_text'  => 'required|string|max:255',
            'description'       => 'required|string',

            // CTA
            'cta_heading'       => 'required|string',
            'cta_description'   => 'required|string',
            'cta_primary_text'  => 'required|string',
            'cta_primary_link'  => 'required|url',
            'cta_primary_icon'  => 'required|string',
            'cta_secondary_text' => 'required|string',
            'cta_secondary_link' => 'required|url',
            'cta_secondary_icon' => 'required|string',

            // Extra Info
            'info_1_icon' => 'required|string',
            'info_1_title' => 'required|string',
            'info_1_subtitle' => 'required|string',
            'info_2_icon' => 'required|string',
            'info_2_title' => 'required|string',
            'info_2_subtitle' => 'required|string',
            'info_3_icon' => 'required|string',
            'info_3_title' => 'required|string',
            'info_3_subtitle' => 'required|string',
        ]);

        // Build services array
        $services = [];
        for ($i = 1; $i <= 6; $i++) {
            $icon = $request->input("service_{$i}_icon");
            $title = $request->input("service_{$i}_title");
            $desc = $request->input("service_{$i}_desc");
            $tag = $request->input("service_{$i}_tag");
            $tag_color = $request->input("service_{$i}_tag_color");
            if ($icon && $title && $desc) {
                $services[] = compact('icon', 'title', 'desc', 'tag', 'tag_color');
            }
        }
        $data['services'] = $services;

        $service->update($data);

        return back()->with('success', 'Services section updated!');
    }
}
