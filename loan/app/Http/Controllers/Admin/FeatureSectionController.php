<?php

// app/Http/Controllers/Admin/FeatureSectionController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeatureSection;
use Illuminate\Http\Request;

class FeatureSectionController extends Controller
{
    public function index()
    {
        $feature = FeatureSection::firstOrCreate([]);
        return view('components.management.features.edit', compact('feature'));
    }

    public function update(Request $request, FeatureSection $feature)
    {
        // Validate the request data
        $validated = $request->validate([
            // Header Section
            'badge_text' => 'required|string|max:255',
            'badge_icon' => 'required|string|max:255',
            'heading' => 'required|string|max:255',
            'highlighted_text' => 'required|string|max:255',
            'description' => 'required|string',

            // Trust Stats Section
            'stat_1_value' => 'required|string|max:50',
            'stat_1_label' => 'required|string|max:255',
            'stat_2_value' => 'required|string|max:50',
            'stat_2_label' => 'required|string|max:255',
            'stat_3_value' => 'required|string|max:50',
            'stat_3_label' => 'required|string|max:255',
            'stat_4_value' => 'required|string|max:50',
            'stat_4_label' => 'required|string|max:255',

            // Features Section
            'icon' => 'required|array|size:6',
            'icon.*' => 'required|string|max:255',
            'title' => 'required|array|size:6',
            'title.*' => 'required|string|max:255',
            'desc' => 'required|array|size:6',
            'desc.*' => 'required|string',
            'learn_more' => 'required|array|size:6',
            'learn_more.*' => 'required|string|max:255',

            // CTA Section
            'cta_heading' => 'required|string|max:255',
            'cta_description' => 'required|string',
            'cta_primary_text' => 'required|string|max:255',
            'cta_primary_link' => 'required|string|max:255',
            'cta_secondary_text' => 'required|string|max:255',
            'cta_secondary_link' => 'required|string|max:255',
        ]);

        try {
            // Prepare features array
            $features = [];
            for ($i = 0; $i < 6; $i++) {
                $features[] = [
                    'icon' => $validated['icon'][$i],
                    'title' => $validated['title'][$i],
                    'desc' => $validated['desc'][$i],
                    'learn_more' => $validated['learn_more'][$i]
                ];
            }

            // Update the feature section
            $feature->update([
                // Header Section
                'badge_text' => $validated['badge_text'],
                'badge_icon' => $validated['badge_icon'],
                'heading' => $validated['heading'],
                'highlighted_text' => $validated['highlighted_text'],
                'description' => $validated['description'],

                // Trust Stats Section
                'stat_1_value' => $validated['stat_1_value'],
                'stat_1_label' => $validated['stat_1_label'],
                'stat_2_value' => $validated['stat_2_value'],
                'stat_2_label' => $validated['stat_2_label'],
                'stat_3_value' => $validated['stat_3_value'],
                'stat_3_label' => $validated['stat_3_label'],
                'stat_4_value' => $validated['stat_4_value'],
                'stat_4_label' => $validated['stat_4_label'],

                // Features Section
                'features' => $features,

                // CTA Section
                'cta_heading' => $validated['cta_heading'],
                'cta_description' => $validated['cta_description'],
                'cta_primary_text' => $validated['cta_primary_text'],
                'cta_primary_link' => $validated['cta_primary_link'],
                'cta_secondary_text' => $validated['cta_secondary_text'],
                'cta_secondary_link' => $validated['cta_secondary_link'],
            ]);

            return back()->with('success', 'Features section updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update features section: ' . $e->getMessage());
        }
    }
}
