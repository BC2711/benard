<?php

// app/Http/Controllers/Admin/ImpactNumbersController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImpactNumbersSection;
use Illuminate\Http\Request;

class ImpactNumbersController extends Controller
{
    public function index()
    {
        $section = ImpactNumbersSection::firstOrCreate([]);
        return view('components.management.counter.edit', compact('section'));
    }

    public function update(Request $request,  $id)
    {
        $section = ImpactNumbersSection::findOrFail($id);
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

        // Main Stats
        $mainStats = [];
        for ($i = 0; $i < 4; $i++) {
            $target = $request->input("main_stat_target_{$i}");
            if ($target !== null) {
                $mainStats[] = [
                    'target' => (int) $target,
                    'suffix' => $request->input("main_stat_suffix_{$i}"),
                    'label' => $request->input("main_stat_label_{$i}"),
                    'icon' => $request->input("main_stat_icon_{$i}"),
                    'progress' => (int) $request->input("main_stat_progress_{$i}", 0),
                ];
            }
        }
        $data['main_stats'] = $mainStats;

        // Performance Metrics
        $metrics = [];
        for ($i = 0; $i < 3; $i++) {
            $value = $request->input("metric_value_{$i}");
            if ($value) {
                $metrics[] = [
                    'value' => $value,
                    'label' => $request->input("metric_label_{$i}"),
                    'icon' => $request->input("metric_icon_{$i}"),
                ];
            }
        }
        $data['performance_metrics'] = $metrics;

        // Industry Impact
        $industry = [];
        for ($i = 0; $i < 4; $i++) {
            $value = $request->input("industry_value_{$i}");
            if ($value) {
                $industry[] = [
                    'value' => $value,
                    'label' => $request->input("industry_label_{$i}"),
                ];
            }
        }
        $data['industry_impact'] = $industry;

        // Timeline
        $timeline = [];
        for ($i = 0; $i < 3; $i++) {
            $year = $request->input("timeline_year_{$i}");
            if ($year) {
                $timeline[] = [
                    'year' => $year,
                    'label' => $request->input("timeline_label_{$i}"),
                    'detail' => $request->input("timeline_detail_{$i}"),
                ];
            }
        }
        $data['timeline'] = $timeline;

        // Trust Badges
        $badges = [];
        $icons = $request->input('badge_icon', []);
        foreach ($icons as $i => $icon) {
            if ($icon && $request->input("badge_text_{$i}")) {
                $badges[] = [
                    'icon' => $icon,
                    'text' => $request->input("badge_text_{$i}"),
                ];
            }
        }
        $data['trust_badges'] = $badges;

        $section->update($data);

        return back()->with('success', 'Impact Numbers updated!');
    }
}
