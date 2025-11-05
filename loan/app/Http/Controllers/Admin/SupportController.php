<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportSection;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index()
    {
        $section = SupportSection::firstOrCreate([]);
        return view('components.management.support.edit', compact('section'));
    }

    public function update(Request $request,  $id)
    {
        $section = SupportSection::findOrFail($id);
        $data = $request->validate([
            'heading' => 'required|string',
            'description' => 'required|string',
            'form_heading' => 'required|string',
            'form_subheading' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address_line1' => 'required|string',
            'address_line2' => 'required|string',
            'hours_line1' => 'required|string',
            'hours_line2' => 'required|string',
            'facebook' => 'required|string',
            'twitter' => 'required|string',
            'linkedin' => 'required|string',
            'instagram' => 'required|string',
        ]);

        // Steps
        $steps = [];
        for ($i = 0; $i < 3; $i++) {
            $title = $request->input("step_title_{$i}");
            if ($title) {
                $steps[] = [
                    'number' => $i + 1,
                    'title' => $title,
                    'desc' => $request->input("step_desc_{$i}"),
                ];
            }
        }
        $data['steps'] = $steps;

        // Trust Indicators
        $trust = [];
        for ($i = 0; $i < 3; $i++) {
            $title = $request->input("trust_title_{$i}");
            if ($title) {
                $trust[] = [
                    'icon' => $request->input("trust_icon_{$i}"),
                    'title' => $title,
                    'desc' => $request->input("trust_desc_{$i}"),
                ];
            }
        }
        $data['trust_indicators'] = $trust;

        $section->update($data);

        return back()->with('success', 'Support section updated!');
    }
}
