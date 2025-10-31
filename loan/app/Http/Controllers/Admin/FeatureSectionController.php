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
        return view('admin.features.edit', compact('feature'));
    }

    public function update(Request $request, FeatureSection $feature)
    {
        $data = $request->validate([
            'badge_text'        => 'required|string|max:255',
            'badge_icon'        => 'required|string',
            'heading'           => 'required|string',
            'highlighted_text'  => 'required|string|max:255',
            'description'       => 'required|string',

            // Stats
            'stat_1_value' => 'required|string',
            'stat_1_label' => 'required|string',
            'stat_2_value' => 'required|string',
            'stat_2_label' => 'required|string',
            'stat_3_value' => 'required|string',
            'stat_3_label' => 'required|string',
            'stat_4_value' => 'required|string',
            'stat_4_label' => 'required|string',

            // CTA
            'cta_heading'       => 'required|string',
            'cta_description'   => 'required|string',
            'cta_primary_text'  => 'required|string',
            'cta_primary_link'  => 'required|url',
            'cta_secondary_text' => 'required|string',
            'cta_secondary_link' => 'required|url',
        ]);

        // Build features array (6)
        $features = [];
        for ($i = 1; $i <= 6; $i++) {
            $icon = $request->input("feature_{$i}_icon");
            $title = $request->input("feature_{$i}_title");
            $desc = $request->input("feature_{$i}_desc");
            $learn = $request->input("feature_{$i}_learn_more");
            if ($icon && $title && $desc) {
                $features[] = array_merge(compact('icon', 'title', 'desc'), ['learn_more' => $learn ?? 'Learn more']);
            }
        }
        $data['features'] = $features;

        $feature->update($data);

        return back()->with('success', 'Features section updated!');
    }
}
