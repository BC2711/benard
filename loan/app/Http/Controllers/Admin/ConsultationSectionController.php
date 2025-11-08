<?php

// app/Http/Controllers/Admin/ConsultationSectionController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConsultationSection;
use Illuminate\Http\Request;

class ConsultationSectionController extends Controller
{
    public function index()
    {
        $section = ConsultationSection::firstOrCreate([]);
        return view('components.management.consultation.edit', compact('section'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'required|string',
            'info_heading' => 'required|string',
            'benefits.*.title' => 'required|string',
            'benefits.*.description' => 'required|string',
            'expect_heading' => 'required|string',
            'expectations.*.text' => 'required|string',
            'contact_heading' => 'required|string',
            'contact_description' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
        ]);

        $section = ConsultationSection::findOrFail($id);
        $section->update([
            'heading' => $request->heading,
            'description' => $request->description,
            'info_heading' => $request->info_heading,
            'benefits' => $request->benefits,
            'expect_heading' => $request->expect_heading,
            'expectations' => $request->expectations,
            'contact_heading' => $request->contact_heading,
            'contact_description' => $request->contact_description,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Consultation section updated!');
    }
}
