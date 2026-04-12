<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Helpers\ImageHelper;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order', 'asc')->get();
        return view('backend.pages.sliders.index', compact('sliders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'link_text' => 'nullable|string|max:255',
            'link_url' => 'nullable|string|max:255',
            'status' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $data = $request->except('_token', 'image');
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['order'] = $request->order ?? 0;

        if ($request->hasFile('image')) {
            $data['image'] = ImageHelper::uploadImage($request->file('image'), 'uploads/sliders');
        }

        Slider::create($data);

        return redirect()->route('sliders.index')->with('success', 'Slider created successfully.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:sliders,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'link_text' => 'nullable|string|max:255',
            'link_url' => 'nullable|string|max:255',
            'status' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $slider = Slider::findOrFail($request->id);
        $data = $request->except('_token', '_method', 'image', 'id');
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['order'] = $request->order ?? 0;

        if ($request->hasFile('image')) {
            $data['image'] = ImageHelper::uploadImage($request->file('image'), 'uploads/sliders', $slider->image);
        } else {
            $data['image'] = $slider->image;
        }

        $slider->update($data);

        return redirect()->route('sliders.index')->with('success', 'Slider updated successfully.');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->image) {
            $oldFilePath = public_path($slider->image);
            if (file_exists($oldFilePath) && !is_dir($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        $slider->delete();

        return redirect()->route('sliders.index')->with('success', 'Slider deleted successfully.');
    }
}
