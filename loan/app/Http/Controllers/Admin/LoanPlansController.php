<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanPlansSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LoanPlansController extends Controller
{
    public function index()
    {
        $plans = LoanPlansSection::firstOrCreate([]);
        return view('components.management.price.edit', compact('plans'));
    }

    public function update(Request $request, $id)
    {
        $plans = LoanPlansSection::findOrFail($id);
        try {
            // -----------------------------------------------------------------
            // 1. Build validation rules dynamically
            // -----------------------------------------------------------------
            $validationRules = [
                // Top-level text fields
                'heading'               => 'required|string',
                'highlighted_text'      => 'required|string',
                'description'           => 'required|string',
                'short_term_label'      => 'required|string',
                'long_term_label'       => 'required|string',
                'short_term_desc'       => 'required|string',
                'long_term_desc'        => 'required|string',
                'custom_badge'          => 'required|string',
                'custom_heading'        => 'required|string',
                'custom_description'    => 'required|string',
                'custom_link_text'      => 'required|string',
                'custom_link'           => 'required|string',
                'custom_link_icon'      => 'required|string',
                'custom_flexible_text'  => 'required|string',
                'custom_flexible_subtext' => 'required|string',
                'custom_rate_text'      => 'required|string',
                'custom_benefits'       => 'required|array|min:1',
                'custom_benefits.*'     => 'required|string',
            ];

            // Add card validation rules dynamically
            $cardCount = 0;
            foreach ($request->all() as $key => $value) {
                if (preg_match('/^card_name_(\d+)$/', $key, $matches) && $request->filled($key)) {
                    $i = $matches[1];
                    $validationRules["card_type_{$i}"] = 'required|in:short,long';
                    $validationRules["card_name_{$i}"] = 'required|string';
                    $validationRules["card_price_{$i}"] = 'required|string';
                    $validationRules["card_term_{$i}"] = 'required|string';
                    $validationRules["card_rate_{$i}"] = 'required|string';
                    $cardCount++;
                }
            }

            if ($cardCount === 0) {
                return back()->with('error', 'At least one pricing card is required.');
            }

            $validated = $request->validate($validationRules);

            // -----------------------------------------------------------------
            // 2. Process custom benefits
            // -----------------------------------------------------------------
            $custom_benefits = array_values(
                array_filter($validated['custom_benefits'], function ($v) {
                    return filled($v) && is_string($v);
                })
            );

            // -----------------------------------------------------------------
            // 3. Build pricing cards (handle features properly)
            // -----------------------------------------------------------------
            $cards = [];

            for ($i = 0; $i <= 5; $i++) { // Based on your request data having cards 0-5
                if (!$request->filled("card_name_{$i}")) {
                    continue;
                }

                // Get features and filter out null/empty values
                $rawFeatures = $request->input("card_features_{$i}", []);
                $features = [];

                if (is_array($rawFeatures)) {
                    foreach ($rawFeatures as $feature) {
                        // Handle null values and empty strings
                        if ($feature !== null && $feature !== '') {
                            $cleanFeature = trim((string)$feature);
                            if (!empty($cleanFeature)) {
                                $features[] = $cleanFeature;
                            }
                        }
                    }
                }

                // Ensure we have at least one feature
                if (empty($features)) {
                    $features = ['Basic features included'];
                }

                $cards[] = [
                    'type'     => $validated["card_type_{$i}"],
                    'name'     => $validated["card_name_{$i}"],
                    'price'    => $validated["card_price_{$i}"],
                    'term'     => $validated["card_term_{$i}"],
                    'rate'     => $validated["card_rate_{$i}"],
                    'features' => $features,
                    'featured' => $request->has("card_featured_{$i}") && $request->input("card_featured_{$i}") === 'on',
                ];
            }

            // -----------------------------------------------------------------
            // 4. Prepare all data for update
            // -----------------------------------------------------------------
            $updateData = [
                'heading' => $validated['heading'],
                'highlighted_text' => $validated['highlighted_text'],
                'description' => $validated['description'],
                'short_term_label' => $validated['short_term_label'],
                'long_term_label' => $validated['long_term_label'],
                'short_term_desc' => $validated['short_term_desc'],
                'long_term_desc' => $validated['long_term_desc'],
                'custom_badge' => $validated['custom_badge'],
                'custom_heading' => $validated['custom_heading'],
                'custom_description' => $validated['custom_description'],
                'custom_link_text' => $validated['custom_link_text'],
                'custom_link' => $validated['custom_link'],
                'custom_link_icon' => $validated['custom_link_icon'],
                'custom_flexible_text' => $validated['custom_flexible_text'],
                'custom_flexible_subtext' => $validated['custom_flexible_subtext'],
                'custom_rate_text' => $validated['custom_rate_text'],
                'custom_benefits' => $custom_benefits,
                'pricing_cards' => $cards,
            ];

            // -----------------------------------------------------------------
            // 5. Debug: Check what's being saved
            // -----------------------------------------------------------------
            Log::info('Updating LoanPlansSection with data:', [
                'heading' => $updateData['heading'],
                'highlighted_text' => $updateData['highlighted_text'],
                'cards_count' => count($updateData['pricing_cards']),
                'cards' => $updateData['pricing_cards']
            ]);

            // -----------------------------------------------------------------
            // 6. Persist to the model
            // -----------------------------------------------------------------
            $plans->update($updateData);

            return back()->with('success', 'Loan Plans updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Throwable $th) {
            Log::error('Error updating LoanPlansSection: ' . $th->getMessage());
            return back()->with('error', 'Loan Plans failed to update! ' . $th->getMessage());
        }
    }
}
