<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cms\SaveMenuItemRequest;
use App\Models\MenuItem;
use App\Models\Page;
use App\Services\FrontendContentService;
use Illuminate\Http\Request;

class CmsNavigationController extends Controller
{
    public function __construct(private readonly FrontendContentService $content)
    {
    }

    public function index()
    {
        return view('pages.admin.cms.navigation.index', [
            'items' => MenuItem::with(['page', 'parent'])->orderBy('location')->orderBy('sort_order')->get(),
            'parents' => MenuItem::orderBy('label')->get(),
            'pages' => Page::orderBy('title')->get(),
        ]);
    }

    public function store(SaveMenuItemRequest $request)
    {
        MenuItem::create($request->validated());
        $this->content->clearCache();

        return back()->with('success', 'Navigation item created.');
    }

    public function update(SaveMenuItemRequest $request, MenuItem $menuItem)
    {
        abort_if((int) $request->input('parent_id') === $menuItem->id, 422, 'A menu item cannot be its own parent.');
        $menuItem->update($request->validated());
        $this->content->clearCache();

        return back()->with('success', 'Navigation item updated.');
    }

    public function destroy(MenuItem $menuItem)
    {
        $menuItem->children()->update(['parent_id' => null]);
        $menuItem->delete();
        $this->content->clearCache();

        return back()->with('success', 'Navigation item deleted.');
    }

    public function reorder(Request $request)
    {
        $data = $request->validate([
            'items' => ['required', 'array'],
            'items.*.id' => ['required', 'exists:menu_items,id'],
            'items.*.sort_order' => ['required', 'integer', 'min:0'],
        ]);

        foreach ($data['items'] as $item) {
            MenuItem::whereKey($item['id'])->update(['sort_order' => $item['sort_order']]);
        }

        $this->content->clearCache();

        return response()->json(['ok' => true]);
    }
}
