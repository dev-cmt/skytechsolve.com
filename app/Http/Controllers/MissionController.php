<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Validator;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mission = Mission::first();

        // Ensure mission_items is properly formatted as array if mission exists
        if ($mission) {
            $mission->mission_items = $mission->getMissionItemsAttribute($mission->mission_items);
        } else {
            $mission = new Mission();
            $mission->mission_items = [];
        }

        return view('backend.pages.mission.index', compact('mission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'mission_items' => 'required|array',
            'mission_items.*.icon_class' => 'required|string|max:255',
            'mission_items.*.title' => 'required|string|max:255',
            'mission_items.*.description' => 'required|string',
            'mission_items.*.order' => 'required|integer',
            'mission_items.*.status' => 'required|in:active,inactive',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $mission = Mission::first();
        if (!$mission) {
            $mission = new Mission();
        }

        $data = $request->except(['_token', '_method']);
        $data['status'] = $request->status === 'active' ? 1 : 0;

        if ($request->hasFile('image_path')) {
            $data['image_path'] = ImageHelper::uploadImage($request->file('image_path'), 'uploads/mission', $mission->image_path);
        } else {
            $data['image_path'] = $mission->image_path;
        }

        // Ensure mission_items is properly formatted as array
        $missionItems = $request->mission_items;

        // Sort by order if needed
        usort($missionItems, function($a, $b) {
            return $a['order'] <=> $b['order'];
        });

        $data['mission_items'] = $missionItems;

        $mission->fill($data);
        $mission->save();

        return redirect()->route('mission.index')->with('success', 'Mission updated successfully.');
    }
}
