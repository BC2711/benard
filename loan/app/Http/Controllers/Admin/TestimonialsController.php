<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestimonialsSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TestimonialsController extends Controller
{
    public function index()
    {
        $section = TestimonialsSection::getSection();
        return view('components.management.testimonials.edit', compact('section'));
    }

    public function update(Request $request,  $id)
    {
        $section = TestimonialsSection::findOrFail($id);
        
        try {
            DB::beginTransaction();

            $request->validate([
                // Header
                'heading' => 'required|string|max:255',
                'description' => 'required|string',

                // Video
                'video_title' => 'required|string|max:255',
                'video_description' => 'required|string',

                // Stats
                'stat_value_0' => 'required_with:stat_label_0|string',
                'stat_label_0' => 'required_with:stat_value_0|string',
                'stat_value_1' => 'required_with:stat_label_1|string',
                'stat_label_1' => 'required_with:stat_value_1|string',
                'stat_value_2' => 'required_with:stat_label_2|string',
                'stat_label_2' => 'required_with:stat_value_2|string',
                'stat_value_3' => 'required_with:stat_label_3|string',
                'stat_label_3' => 'required_with:stat_value_3|string',

                // CTA
                'cta_heading' => 'required|string|max:255',
                'cta_description' => 'required|string',
                'cta_primary_text' => 'required|string',
                'cta_primary_link' => 'required|string',
                'cta_primary_icon' => 'required|string',
                'cta_secondary_text' => 'required|string',
                'cta_secondary_link' => 'required|string',
                'cta_secondary_icon' => 'required|string',

                // Testimonials
                'testimonial_name_0' => 'required_with:testimonial_quote_0|string',
                'testimonial_role_0' => 'required_with:testimonial_name_0|string',
                'testimonial_quote_0' => 'required_with:testimonial_name_0|string',
                'testimonial_rating_0' => 'nullable|integer|between:1,5',

                'testimonial_name_1' => 'required_with:testimonial_quote_1|string',
                'testimonial_role_1' => 'required_with:testimonial_name_1|string',
                'testimonial_quote_1' => 'required_with:testimonial_name_1|string',
                'testimonial_rating_1' => 'nullable|integer|between:1,5',

                'testimonial_name_2' => 'required_with:testimonial_quote_2|string',
                'testimonial_role_2' => 'required_with:testimonial_name_2|string',
                'testimonial_quote_2' => 'required_with:testimonial_name_2|string',
                'testimonial_rating_2' => 'nullable|integer|between:1,5',

                'testimonial_name_3' => 'required_with:testimonial_quote_3|string',
                'testimonial_role_3' => 'required_with:testimonial_name_3|string',
                'testimonial_quote_3' => 'required_with:testimonial_name_3|string',
                'testimonial_rating_3' => 'nullable|integer|between:1,5',

                // Uploads - Reduced file size limits and made video file optional
                'video_image_upload' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024', // Reduced to 1MB
                'video_file_upload'  => 'nullable|file|mimes:mp4,mov,avi,m4v,webm|max:10240',
                'testimonial_image_upload_0' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
                'testimonial_image_upload_1' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
                'testimonial_image_upload_2' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
                'testimonial_image_upload_3' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
            ]);

            // === Video Image ===
            if ($request->hasFile('video_image_upload')) {
                try {
                    if ($section->video_image_path) {
                        Storage::disk('public')->delete($section->video_image_path);
                    }
                    $videoImagePath = $request->file('video_image_upload')
                        ->store('testimonials/video', 'public');
                    $section->video_image_path = $videoImagePath;
                    $section->video_image = null;
                } catch (\Exception $e) {
                    throw new \Exception("Failed to upload video image: " . $e->getMessage());
                }
            }

            // === Video File ===
            if ($request->hasFile('video_file_upload')) {
                $videoFile = $request->file('video_file_upload');

                Log::info('Video file details', [
                    'file_name' => $videoFile->getClientOriginalName(),
                    'file_size' => $videoFile->getSize(),
                    'mime_type' => $videoFile->getMimeType(),
                    'error_code' => $videoFile->getError(),
                    'is_valid' => $videoFile->isValid(),
                    'path' => $videoFile->getPath(),
                ]);

                if ($videoFile->isValid()) {
                    try {
                        // Delete old video file if exists
                        if ($section->video_file_path) {
                            Storage::disk('public')->delete($section->video_file_path);
                        }

                        // Store the new video file
                        $videoFilePath = $videoFile->store('testimonials/videos', 'public');
                        $section->video_file_path = $videoFilePath;
                        $section->video_url = null;

                        Log::info('Video file uploaded successfully', [
                            'storage_path' => $videoFilePath,
                            'file_size' => $videoFile->getSize(),
                        ]);
                    } catch (\Exception $e) {
                        Log::error('Video file storage failed: ' . $e->getMessage());
                        throw new \Exception("Failed to store video file: " . $e->getMessage());
                    }
                } else {
                    $errorCode = $videoFile->getError();
                    $errorMessages = [
                        0 => 'File uploaded successfully',
                        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
                        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive in HTML form',
                        3 => 'The uploaded file was only partially uploaded',
                        4 => 'No file was uploaded',
                        6 => 'Missing a temporary folder',
                        7 => 'Failed to write file to disk',
                        8 => 'A PHP extension stopped the file upload',
                    ];

                    $errorMessage = $errorMessages[$errorCode] ?? "Unknown upload error (Code: {$errorCode})";

                    Log::error('Video file upload failed', [
                        'error_code' => $errorCode,
                        'error_message' => $errorMessage,
                        'file_name' => $videoFile->getClientOriginalName(),
                    ]);

                    // Don't throw exception for upload errors, just log and continue
                    // This allows the form to be submitted without the video
                    session()->flash('warning', 'Video upload skipped: ' . $errorMessage);
                }
            }

            // === Stats ===
            $stats = [];
            for ($i = 0; $i < 4; $i++) {
                $value = $request->input("stat_value_{$i}");
                $label = $request->input("stat_label_{$i}");
                if ($value && $label) {
                    $stats[] = ['value' => $value, 'label' => $label];
                }
            }

            // === Testimonials (with image upload) ===
            $testimonials = [];

            for ($i = 0; $i < 4; $i++) {
                $name = $request->input("testimonial_name_{$i}");
                $quote = $request->input("testimonial_quote_{$i}");

                if (!$name || !$quote) continue;

                $testimonial = [
                    'name'   => $name,
                    'role'   => $request->input("testimonial_role_{$i}"),
                    'quote'  => $quote,
                    'rating' => (int) $request->input("testimonial_rating_{$i}", 5),
                    'image'  => $request->input("testimonial_image_{$i}", ''),
                ];

                // Upload avatar if provided
                $fileKey = "testimonial_image_upload_{$i}";
                if ($request->hasFile($fileKey)) {
                    $testimonialImage = $request->file($fileKey);

                    if ($testimonialImage->isValid()) {
                        try {
                            // Delete old image if exists
                            if (
                                isset($section->testimonials[$i]['image']) &&
                                !empty($section->testimonials[$i]['image']) &&
                                strpos($section->testimonials[$i]['image'], 'http') !== 0
                            ) {
                                Storage::disk('public')->delete($section->testimonials[$i]['image']);
                            }

                            $path = $testimonialImage->store('testimonials/avatars', 'public');
                            $testimonial['image'] = $path; // store path in JSON
                        } catch (\Exception $e) {
                            throw new \Exception("Failed to upload testimonial image {$i}: " . $e->getMessage());
                        }
                    }
                } elseif (isset($section->testimonials[$i]['image'])) {
                    // Keep existing image if no new upload
                    $testimonial['image'] = $section->testimonials[$i]['image'];
                }

                $testimonials[] = $testimonial;
            }

            // Prepare update data
            $updateData = [
                'heading' => $request->heading,
                'description' => $request->description,
                'video_title' => $request->video_title,
                'video_description' => $request->video_description,
                'stats' => $stats,
                'cta_heading' => $request->cta_heading,
                'cta_description' => $request->cta_description,
                'cta_primary_text' => $request->cta_primary_text,
                'cta_primary_link' => $request->cta_primary_link,
                'cta_primary_icon' => $request->cta_primary_icon,
                'cta_secondary_text' => $request->cta_secondary_text,
                'cta_secondary_link' => $request->cta_secondary_link,
                'cta_secondary_icon' => $request->cta_secondary_icon,
                'testimonials' => $testimonials,
            ];

            // Only add file paths if they were updated
            if (isset($videoImagePath)) {
                $updateData['video_image_path'] = $videoImagePath;
            }
            if (isset($videoFilePath)) {
                $updateData['video_file_path'] = $videoFilePath;
            }

            // === Update the section ===
            try {
                $section->update($updateData);
            } catch (\Exception $e) {
                throw new \Exception("Failed to update database: " . $e->getMessage());
            }

            DB::commit();

            return back()->with('success', 'Testimonials section updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Testimonials section update failed: ' . $e->getMessage(), [
                'section_id' => $section->id,
                'user_id' => Auth::user()->id,
                'request_data' => $request->except(['_token', '_method', 'video_file_upload'])
            ]);

            return back()->with('error', 'Failed to update testimonials section: ' . $e->getMessage())->withInput();
        }
    }
}
