<?php

// app/Http/Controllers/Admin/TeamSectionController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamSection;
use Illuminate\Http\Request;

class TeamSectionController extends Controller
{
    public function index()
    {
        $team = TeamSection::firstOrCreate([]);
        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, TeamSection $team)
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

        // Build members
        $members = [];
        $names = $request->input('member_name', []);
        foreach ($names as $i => $name) {
            if ($name) {
                $social = [];
                $icons = $request->input("member_social_icon_{$i}", []);
                $urls = $request->input("member_social_url_{$i}", []);
                $colors = $request->input("member_social_color_{$i}", []);
                foreach ($icons as $j => $icon) {
                    if ($icon && $urls[$j]) {
                        $social[] = ['icon' => $icon, 'url' => $urls[$j], 'color' => $colors[$j] ?? 'primary'];
                    }
                }
                $members[] = [
                    'name' => $name,
                    'role' => $request->input("member_role_{$i}"),
                    'bio' => $request->input("member_bio_{$i}"),
                    'image' => $request->input("member_image_{$i}"),
                    'social' => $social,
                ];
            }
        }
        $data['members'] = $members;

        $team->update($data);

        return back()->with('success', 'Team section updated!');
    }
}
