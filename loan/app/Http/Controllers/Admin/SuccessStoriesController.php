<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuccessStoriesSection;
use Illuminate\Http\Request;

class SuccessStoriesController extends Controller
{
    public function index()
    {
        $section = SuccessStoriesSection::firstOrCreate([]);
        return view('admin.success-stories.edit', compact('section'));
    }

    public function update(Request $request, SuccessStoriesSection $section)
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

        // Categories
        $categories = array_filter($request->input('categories', []));
        $data['categories'] = $categories;

        // Stories
        $stories = [];
        $titles = $request->input('story_title', []);
        foreach ($titles as $i => $title) {
            if ($title) {
                $tags = array_filter($request->input("story_tags_{$i}", []));
                $stories[] = [
                    'title' => $title,
                    'amount' => $request->input("story_amount_{$i}"),
                    'category' => $request->input("story_category_{$i}"),
                    'funding' => $request->input("story_funding_{$i}"),
                    'type' => $request->input("story_type_{$i}"),
                    'result' => $request->input("story_result_{$i}"),
                    'time' => $request->input("story_time_{$i}"),
                    'description' => $request->input("story_description_{$i}"),
                    'overlay_title' => $request->input("story_overlay_title_{$i}"),
                    'overlay_desc' => $request->input("story_overlay_desc_{$i}"),
                    'tags' => $tags,
                    'gradient_from' => $request->input("story_gradient_from_{$i}"),
                    'gradient_to' => $request->input("story_gradient_to_{$i}"),
                ];
            }
        }
        $data['stories'] = $stories;

        $section->update($data);

        return back()->with('success', 'Success Stories updated!');
    }
}
