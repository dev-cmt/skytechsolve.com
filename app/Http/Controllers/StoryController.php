<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Validator;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $story = Story::first();

        // If no story exists, create a default one
        if (!$story) {
            $story = Story::create([
                'title' => 'Our Story',
                'content' => '<h2>Welcome to Our Story</h2><p>Tell your amazing story here...</p>',
                'status' => true
            ]);
        }

        return view('backend.pages.story.index', compact('story'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|boolean',
            'remove_image' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $story = Story::findOrFail($id);
        $data = $request->except('image', 'remove_image');

        // Handle image upload/removal
        if ($request->hasFile('image')) {
            $data['image'] = ImageHelper::uploadImage($request->file('image'), 'uploads/story', $story->image);
        } elseif ($request->has('remove_image') && $request->remove_image) {
            // Remove existing image
            if ($story->image) {
                ImageHelper::deleteImage($story->image);
                $data['image'] = null;
            }
        } else {
            // Keep the existing image
            $data['image'] = $story->image;
        }

        $story->update($data);

        return redirect()->route('story.index')
            ->with('success', 'Story updated successfully.');
    }
}
