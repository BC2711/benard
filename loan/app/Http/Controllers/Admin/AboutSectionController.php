<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = AboutSection::firstOrCreate([]);
        return view('components.website.about', compact('about'));
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
    public function update(Request $request, AboutSection $about)
    {
        $rules = [
            'section_label'     => 'required|string|max:255',
            'heading'           => 'required|string',
            'highlighted_text'  => 'required|string|max:255',
            'description'       => 'required|string',
            'cta_text'          => 'required|string',
            'cta_link'          => 'required|url',

            // Stats
            'stat_1_value' => 'required|string',
            'stat_1_label' => 'required|string',
            'stat_2_value' => 'required|string',
            'stat_2_label' => 'required|string',
            'stat_3_value' => 'required|string',
            'stat_3_label' => 'required|string',
            'stat_4_value' => 'required|string',
            'stat_4_label' => 'required|string',

            // Images
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_4' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',

            // Rating card
            'rating_icon'   => 'required|string',
            'rating_value'  => 'required|string',
            'rating_subtitle' => 'required|string',
        ];

        $data = $request->validate($rules);

        // Handle images
        foreach (['image_1', 'image_2', 'image_3', 'image_4'] as $field) {
            if ($request->hasFile($field)) {
                if ($about->{$field}) {
                    Storage::delete('public/' . $about->{$field});
                }
                $data[$field] = $request->file($field)->store('about', 'public');
            }
        }

        // Features – 4 repeatable blocks
        $features = [];
        for ($i = 1; $i <= 4; $i++) {
            $icon = $request->input("feature_{$i}_icon");
            $title = $request->input("feature_{$i}_title");
            $desc  = $request->input("feature_{$i}_desc");
            if ($icon && $title && $desc) {
                $features[] = compact('icon', 'title', 'desc');
            }
        }
        $data['features'] = $features;

        $about->update($data);

        return back()->with('success', 'About section updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
