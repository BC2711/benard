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
        return view('components.management.service.edit', compact('service'));
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
            'cta_primary_link'  => 'required|string',
            'cta_primary_icon'  => 'required|string',
            'cta_secondary_text' => 'required|string',
            'cta_secondary_link' => 'required|string',
            'cta_secondary_icon' => 'required|string',

            // Services validation 
            'icon' => 'required|array|size:6',
            'icon.*' => 'required|string',
            'title' => 'required|array|size:6',
            'title.*' => 'required|string',
            'desc' => 'required|array|size:6',
            'desc.*' => 'required|string',
            'tag' => 'nullable|array|size:6',
            'tag.*' => 'nullable|string',
            'tag_color' => 'required|array|size:6',
            'tag_color.*' => 'required|string|in:primary,secondary',

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
        for ($i = 0; $i < 6; $i++) {
            $services[] = [
                'icon' => $data['icon'][$i],
                'title' => $data['title'][$i],
                'desc' => $data['desc'][$i],
                'tag' => $data['tag'][$i] ?? null,
                'tag_color' => $data['tag_color'][$i],
            ];
        }
        $data['services'] = $services;

        $service->update($data);

        return back()->with('success', 'Services section updated successfully!');
    }
}
