<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::orderBy('sort_order')->paginate(10);
        return view('backend.pages.achievements.index', compact('achievements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'count' => 'required|integer',
            'suffix' => 'nullable|string|max:10',
            'status' => 'required|in:active,inactive'
        ]);

        Achievement::create($request->all());

        return redirect()->back()->with('success', 'Achievement created successfully.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:achievements,id',
            'title' => 'required|string|max:255',
            'count' => 'required|integer',
            'suffix' => 'nullable|string|max:10',
            'status' => 'required|in:active,inactive'
        ]);

        $achievement = Achievement::findOrFail($request->id);
        $achievement->update($request->all());

        return redirect()->back()->with('success', 'Achievement updated successfully.');
    }

    public function destroy($id)
    {
        $achievement = Achievement::findOrFail($id);
        $achievement->delete();

        return redirect()->back()->with('success', 'Achievement deleted successfully.');
    }
}
