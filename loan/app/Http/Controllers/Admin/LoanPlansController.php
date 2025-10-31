<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanPlansSection;
use Illuminate\Http\Request;

class LoanPlansController extends Controller
{
    public function index()
    {
        $plans = LoanPlansSection::firstOrCreate([]);
        return view('admin.loan-plans.edit', compact('plans'));
    }

    public function update(Request $request, LoanPlansSection $plans)
    {
        $data = $request->validate([
            'heading' => 'required|string',
            'highlighted_text' => 'required|string',
            'description' => 'required|string',
            'short_term_label' => 'required|string',
            'long_term_label' => 'required|string',
            'short_term_desc' => 'required|string',
            'long_term_desc' => 'required|string',
            'custom_badge' => 'required|string',
            'custom_heading' => 'required|string',
            'custom_description' => 'required|string',
            'custom_link_text' => 'required|string',
            'custom_link' => 'required|url',
            'custom_link_icon' => 'required|string',
            'custom_flexible_text' => 'required|string',
            'custom_flexible_subtext' => 'required|string',
            'custom_rate_text' => 'required|string',
        ]);

        // Custom benefits
        $benefits = array_filter($request->input('custom_benefits', []));
        $data['custom_benefits'] = $benefits;

        // Pricing cards (dynamic)
        $cards = [];
        $cardNames = $request->input('card_name', []);
        foreach ($cardNames as $i => $name) {
            if ($name) {
                $cards[] = [
                    'type' => $request->input("card_type_{$i}"),
                    'name' => $name,
                    'price' => $request->input("card_price_{$i}"),
                    'term' => $request->input("card_term_{$i}"),
                    'rate' => $request->input("card_rate_{$i}"),
                    'features' => array_filter($request->input("card_features_{$i}", [])),
                    'featured' => $request->has("card_featured_{$i}"),
                ];
            }
        }
        $data['pricing_cards'] = $cards;

        $plans->update($data);

        return back()->with('success', 'Loan Plans updated!');
    }
}
