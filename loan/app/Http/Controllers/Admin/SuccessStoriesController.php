<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuccessStoriesSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class SuccessStoriesController extends Controller
{
    public function index()
    {
        $section = SuccessStoriesSection::firstOrCreate([]);
        return view('components.management.success-stories.edit', compact('section'));
    }

    public function update(Request $request, $id)
    {
        $section = SuccessStoriesSection::findOrFail($id);
        try {
            $request->validate([
                'heading'            => 'required|string|max:255',
                'description'        => 'required|string',
                'cta_heading'        => 'required|string|max:255',
                'cta_description'    => 'required|string',
                'cta_primary_text'   => 'required|string|max:100',
                'cta_primary_link'   => 'required|string|max:255',
                'cta_primary_icon'   => 'required|string|max:50',
                'cta_secondary_text' => 'required|string|max:100',
                'cta_secondary_link' => 'required|string|max:255',
                'cta_secondary_icon' => 'required|string|max:50',

                'stat_value_*'       => 'required|string|max:50',
                'stat_label_*'       => 'required|string|max:100',

                'categories'         => 'required|string',

                'story_title_*'        => 'required|string|max:255',
                'story_amount_*'       => 'required|string|max:100',
                'story_category_*' => 'required|string|in:' . implode(',', $section->categories),
                'story_funding_*'      => 'required|string|max:50',
                'story_type_*'         => 'required|string|max:100',
                'story_result_*'       => 'required|string|max:100',
                'story_time_*'         => 'required|string|max:50',
                'story_description_*'  => 'required|string',
                'story_overlay_title_*' => 'required|string|max:255',
                'story_overlay_desc_*' => 'required|string|max:255',
                'story_gradient_from_*' => 'required|string|max:50',
                'story_gradient_to_*'  => 'required|string|max:50',
                'story_tags_*'         => 'required|array|min:1',
                'story_tags_*.0'       => 'required|string|max:100',
                'story_tags_*.1'       => 'nullable|string|max:100',
                'story_tags_*.2'       => 'nullable|string|max:100',
            ]);

            // Stats
            $stats = collect(range(0, 3))->map(function ($i) use ($request) {
                return [
                    'value' => $request->input("stat_value_{$i}"),
                    'label' => $request->input("stat_label_{$i}"),
                ];
            })->toArray();

            // Categories
            $categories = array_values(array_unique(array_filter(array_map('trim', explode(',', $request->categories)))));

            // Stories
            $stories = [];
            $index = 0;
            while ($request->has("story_title_{$index}")) {
                $tags = array_values(array_filter($request->input("story_tags_{$index}", []), 'filled'));

                $stories[] = [
                    'title'         => $request->input("story_title_{$index}"),
                    'amount'        => $request->input("story_amount_{$index}"),
                    'category'      => $request->input("story_category_{$index}"),
                    'funding'       => $request->input("story_funding_{$index}"),
                    'type'          => $request->input("story_type_{$index}"),
                    'result'        => $request->input("story_result_{$index}"),
                    'time'          => $request->input("story_time_{$index}"),
                    'description'   => $request->input("story_description_{$index}"),
                    'overlay_title' => $request->input("story_overlay_title_{$index}"),
                    'overlay_desc'  => $request->input("story_overlay_desc_{$index}"),
                    'gradient_from' => $request->input("story_gradient_from_{$index}"),
                    'gradient_to'   => $request->input("story_gradient_to_{$index}"),
                    'tags'          => $tags,
                ];
                $index++;
            }

            $data = $section->update([
                'heading'            => $request->heading,
                'description'        => $request->description,
                'stats'              => $stats,
                'categories'         => $categories,
                'cta_heading'        => $request->cta_heading,
                'cta_description'    => $request->cta_description,
                'cta_primary_text'   => $request->cta_primary_text,
                'cta_primary_link'   => $request->cta_primary_link,
                'cta_primary_icon'   => $request->cta_primary_icon,
                'cta_secondary_text' => $request->cta_secondary_text,
                'cta_secondary_link' => $request->cta_secondary_link,
                'cta_secondary_icon' => $request->cta_secondary_icon,
                'stories'            => $stories,
            ]);
            if ($data) {
                return back()->with('success', 'Success Stories updated successfully!');
            } else {
                dd($data);
            }
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Throwable $e) {
            Log::error('Success Stories update failed', [
                'section_id' => $section->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Failed to save. Please check your input and try again.');
        }
    }
}
