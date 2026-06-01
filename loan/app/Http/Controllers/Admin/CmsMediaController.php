<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cms\UploadMediaRequest;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CmsMediaController extends Controller
{
    public function index(Request $request)
    {
        $media = Media::query()
            ->when($request->search, fn ($query, $search) => $query->where('name', 'like', "%$search%"))
            ->when($request->folder, fn ($query, $folder) => $query->where('folder', $folder))
            ->latest()
            ->paginate(24)
            ->withQueryString();

        return view('pages.admin.cms.media.index', [
            'media' => $media,
            'folders' => Media::query()->distinct()->orderBy('folder')->pluck('folder'),
        ]);
    }

    public function store(UploadMediaRequest $request)
    {
        $file = $request->file('file');
        $folder = trim($request->string('folder')->toString(), '/') ?: 'general';
        $path = $file->store("cms/$folder", 'public');

        Media::create([
            ...$request->safe()->only(['folder', 'name', 'alt_text', 'caption']),
            'disk' => 'public',
            'path' => $path,
            'name' => $request->input('name') ?: $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'uploaded_by' => Auth::id(),
        ]);

        return back()->with('success', 'Media uploaded.');
    }

    public function update(Request $request, Media $medium)
    {
        $medium->update($request->validate([
            'folder' => ['required', 'string', 'max:120'],
            'name' => ['required', 'string', 'max:180'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'caption' => ['nullable', 'string', 'max:255'],
        ]));

        return back()->with('success', 'Media details updated.');
    }

    public function destroy(Media $medium)
    {
        Storage::disk($medium->disk)->delete($medium->path);
        $medium->delete();

        return back()->with('success', 'Media deleted.');
    }
}
