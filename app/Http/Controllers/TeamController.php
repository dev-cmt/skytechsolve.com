<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Helpers\ImageHelper;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::with('seo')->latest()->paginate(10);
        return view('backend.pages.teams.index', compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'meta_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Generate slug
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $count = 1;
        while (Team::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $data['slug'] = $slug;

        if ($request->hasFile('image')) {
            $data['image'] = ImageHelper::uploadImage($request->file('image'), 'uploads/team');
        }

        $team = Team::create($data);

        // SEO Data
        $seoData = [
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ];

        if ($request->hasFile('meta_image')) {
            $seoData['og_image'] = ImageHelper::uploadImage($request->file('meta_image'), 'uploads/seo');
        }

        $team->seo()->create($seoData);

        return redirect()->route('team.index')
            ->with('success', 'Team member created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:teams,id',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'meta_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $team = Team::findOrFail($request->id);
        $data = $request->all();

        // Update slug if name changed
        if ($team->name !== $request->name) {
            $slug = Str::slug($request->name);
            $originalSlug = $slug;
            $count = 1;
            while (Team::where('slug', $slug)->where('id', '!=', $team->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
            $data['slug'] = $slug;
        }

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($team->image) {
                ImageHelper::deleteImage($team->image);
            }
            $data['image'] = ImageHelper::uploadImage($request->file('image'), 'uploads/team');
        }

        $team->update($data);

        // SEO Data
        $seoData = [
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ];

        if ($request->hasFile('meta_image')) {
            // Delete old OG image if exists
            if ($team->seo && $team->seo->og_image) {
                ImageHelper::deleteImage($team->seo->og_image);
            }
            $seoData['og_image'] = ImageHelper::uploadImage($request->file('meta_image'), 'uploads/seo');
        }

        if ($team->seo) {
            $team->seo->update($seoData);
        } else {
            $team->seo()->create($seoData);
        }

        return redirect()->route('team.index')
            ->with('success', 'Team member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        // Delete image if exists
        if ($team->image) {
            ImageHelper::deleteImage($team->image);
        }

        $team->delete();

        return redirect()->route('team.index')
            ->with('success', 'Team member deleted successfully.');
    }
}
