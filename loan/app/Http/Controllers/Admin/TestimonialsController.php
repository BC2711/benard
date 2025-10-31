<?php

// app/Http/Controllers/Admin/TestimonialsController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestimonialsSection;
use Illuminate\Http\Request;

class TestimonialsController extends Controller
{
    public function index()
    {
        $section = TestimonialsSection::firstOrCreate([]);
        return view('admin.testimonials.edit', compact('section'));
    }

    public function update(Request $request, TestimonialsSection $section)
    {
        $data = $request->validate([
            'heading' => 'required|string',
            'description' => 'required|string',
            'video_title' => 'required|string',
            'video_description' => 'required|string',
            'video_image' => 'required|url',
            'video_url' => 'nullable|url',
            'cta_heading' => 'required|string',
            'cta_description' => 'required|string',
            'cta_primary_text' => 'required|string',
            'cta_primary_link' => 'required|url',
            'cta_primary_icon' => 'required|string',
            'cta_secondary_text' => 'required|string',
            'cta_secondary_link' => 'required|url',
            'cta_secondary_icon' => 'required|string',
        ]);

        // Stats
        $stats = [];
        for ($i = 0; $i < 4; $i++) {
            $value = $request->input("stat_value_{$i}");
            $label = $request->input("stat_label_{$i}");
            if ($value && $label) {
                $stats[] = compact('value', 'label');
            }
        }
        $data['stats'] = $stats;

        // Testimonials
        $testimonials = [];
        $names = $request->input('testimonial_name', []);
        foreach ($names as $i => $name) {
            if ($name) {
                $testimonials[] = [
                    'name' => $name,
                    'role' => $request->input("testimonial_role_{$i}"),
                    'quote' => $request->input("testimonial_quote_{$i}"),
                    'image' => $request->input("testimonial_image_{$i}"),
                    'rating' => (int) $request->input("testimonial_rating_{$i}", 5),
                ];
            }
        }
        $data['testimonials'] = $testimonials;

        $section->update($data);

        return back()->with('success', 'Testimonials section updated!');
    }
}
