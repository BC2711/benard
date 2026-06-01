<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\FrontendContentService;
use Illuminate\Http\Request;

class CmsSettingController extends Controller
{
    public function __construct(private readonly FrontendContentService $content)
    {
    }

    public function edit()
    {
        return view('pages.admin.cms.settings.edit', [
            'settings' => Setting::all()->groupBy('group')->map->pluck('value', 'key')->toArray(),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'settings' => ['required', 'array'],
            'settings.*' => ['array'],
            'settings.*.*' => ['nullable', 'string', 'max:2000'],
        ]);

        foreach ($data['settings'] as $group => $settings) {
            foreach ($settings as $key => $value) {
                Setting::updateOrCreate(
                    ['group' => $group, 'key' => $key],
                    ['value' => [$value], 'type' => 'text', 'is_public' => true]
                );
            }
        }

        $this->content->clearCache();

        return back()->with('success', 'Website settings updated.');
    }
}
