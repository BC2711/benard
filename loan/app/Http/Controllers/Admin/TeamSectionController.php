<?php

// app/Http/Controllers/Admin/TeamSectionController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamSectionController extends Controller
{
    public function index()
    {
        $team = TeamSection::getInstance();
        return view('components.management.team.edit', compact('team'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'required|string',
            'cta_heading' => 'required|string|max:255',
            'cta_description' => 'required|string',
            'cta_primary_text' => 'required|string',
            'cta_primary_link' => 'required|string',
            'cta_primary_icon' => 'required|string',
            'cta_secondary_text' => 'required|string',
            'cta_secondary_link' => 'required|string',
            'cta_secondary_icon' => 'required|string',
        ]);

        $team = TeamSection::getInstance();
        $oldMembers = $team->members ?? [];
        $oldImages = collect($oldMembers)->pluck('image')->filter()->toArray();

        $members = [];
        $names = $request->input('member_name', []);
        $roles = $request->input('member_role', []);
        $bios = $request->input('member_bio', []);
        $oldImagesInput = $request->input('member_image_old', []);

        // Get the uploaded files as array
        $memberImages = $request->file('member_image', []);

        foreach ($names as $i => $name) {
            if (!$name) continue;

            $image = $oldImagesInput[$i] ?? null;

            // Check if there's a new image uploaded for this member
            if (isset($memberImages[$i]) && $memberImages[$i]->isValid()) {
                $file = $memberImages[$i];
                $filename = time() . "_{$i}." . $file->getClientOriginalExtension();

                // This will create the directory if it doesn't exist
                Storage::disk('public')->putFileAs('teams', $file, $filename);
                $image = $filename;

                // Delete old image if it exists
                if (!empty($oldImagesInput[$i])) {
                    Storage::disk('public')->delete('teams/' . $oldImagesInput[$i]);
                }
            }

            // Handle social links - adjust based on your actual form structure
            $social = [];
            $icons = $request->input("member_social_icon.{$i}", []);
            $urls = $request->input("member_social_url.{$i}", []);
            $colors = $request->input("member_social_color.{$i}", []);

            foreach ($icons as $j => $icon) {
                if ($icon && isset($urls[$j]) && $urls[$j]) {
                    $social[] = [
                        'icon' => $icon,
                        'url' => $urls[$j],
                        'color' => $colors[$j] ?? 'primary'
                    ];
                }
            }

            $members[] = [
                'name' => $name,
                'role' => $roles[$i] ?? '',
                'bio' => $bios[$i] ?? '',
                'image' => $image,
                'social' => $social
            ];
        }

        // Delete removed images
        $newImages = collect($members)->pluck('image')->filter()->toArray();
        foreach ($oldImages as $old) {
            if (!empty($old) && !in_array($old, $newImages)) {
                Storage::disk('public')->delete('teams/' . $old);
            }
        }

        $team->update([
            'heading' => $request->heading,
            'description' => $request->description,
            'cta_heading' => $request->cta_heading,
            'cta_description' => $request->cta_description,
            'cta_primary_text' => $request->cta_primary_text,
            'cta_primary_link' => $request->cta_primary_link,
            'cta_primary_icon' => $request->cta_primary_icon,
            'cta_secondary_text' => $request->cta_secondary_text,
            'cta_secondary_link' => $request->cta_secondary_link,
            'cta_secondary_icon' => $request->cta_secondary_icon,
            'members' => $members
        ]);

        return back()->with('success', 'Team section updated successfully!');
    }
}
