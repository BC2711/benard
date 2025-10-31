<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hero = HeroSection::firstOrCreate([]);
        return view('website.hero', compact('hero'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HeroSection $hero)
    {
        $data = $request->validate([
            'brand_name' => 'required|string|max:255',
            'brand_tagline' => 'required|string|max:255',
            'heading' => 'required|string',
            'highlighted_text' => 'required|string|max:255',
            'description' => 'required|string',
            'cta_text' => 'required|string',
            'cta_link' => 'required|url',
            'phone_number' => 'required|string',
            'phone_label' => 'required|string',

            'stat_1_value' => 'required|string',
            'stat_1_label' => 'required|string',
            'stat_2_value' => 'required|string',
            'stat_2_label' => 'required|string',
            'stat_3_value' => 'required|string',
            'stat_3_label' => 'required|string',
            'stat_4_value' => 'required|string',
            'stat_4_label' => 'required|string',

            'card_title' => 'required|string',
            'card_description' => 'required|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',

            'badge_1_icon' => 'required|string',
            'badge_1_title' => 'required|string',
            'badge_1_subtitle' => 'required|string',
            'badge_2_icon' => 'required|string',
            'badge_2_title' => 'required|string',
            'badge_2_subtitle' => 'required|string',
        ]);

        if ($request->hasFile('hero_image')) {
            if ($hero->hero_image) {
                Storage::delete('public/' . $hero->hero_image);
            }
            $data['hero_image'] = $request->file('hero_image')->store('hero', 'public');
        }

        $hero->update($data);

        return redirect()->back()->with('success', 'Hero section updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
