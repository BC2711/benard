<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanCalculator;
use Illuminate\Http\Request;

class LoanCalculatorController extends Controller
{
    public function index()
    {
        $calc = LoanCalculator::firstOrCreate([]);

        return view('components.management.calculator.edit', compact('calc'));
    }

    public function update(Request $request, LoanCalculator $calculator)
    {
        $data = $request->validate([
            'hero_title' => 'required|string',
            'hero_description' => 'required|string',
            'stat_loan_range' => 'required|string',
            'stat_interest_rates' => 'required|string',
            'stat_loan_terms' => 'required|string',
            'stat_payment_options' => 'required|string',
            'min_amount' => 'required|integer',
            'max_amount' => 'required|integer',
            'default_amount' => 'required|integer',
            'min_rate' => 'required|numeric',
            'max_rate' => 'required|numeric',
            'default_rate' => 'required|numeric',
            'min_days' => 'required|integer',
            'max_days' => 'required|integer',
            'default_days' => 'required|integer',
            'min_months' => 'required|integer',
            'max_months' => 'required|integer',
            'default_months' => 'required|integer',
            'cta_heading' => 'required|string',
            'cta_description' => 'required|string',
            'cta_apply_text' => 'required|string',
            'cta_apply_url' => 'required|string',
            'cta_contact_text' => 'required|string',
            'cta_contact_url' => 'required|string',
        ]);

        // Payment Schedules
        $schedules = [];
        foreach ($request->all() as $key => $label) {
            if (preg_match('/^schedule_label_(\d+)$/', $key, $matches) && filled($label)) {
                $days = $request->input("schedule_days_{$matches[1]}");
                if (!$days) {
                    continue;
                }

                $schedules[] = [
                    'days' => $days,
                    'label' => $label,
                ];
            }
        }
        $data['payment_schedules'] = $schedules;

        $calculator->update($data);

        return back()->with('success', 'Calculator updated!');
    }
}
