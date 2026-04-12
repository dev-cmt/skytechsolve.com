<?php
namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::latest()->paginate(10);
        return view('backend.pages.features.index', compact('features'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'feature_name' => 'required|string|max:255|unique:features',
            'icon_class' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive'
        ]);

        Feature::create($request->all());

        return redirect()->route('features.index')
            ->with('success', 'Feature created successfully.');
    }

    public function update(Request $request)
    {
        $feature = Feature::find($request->id);
        $request->validate([
            'feature_name' => 'required|string|max:255|unique:features,feature_name,' . $feature->id,
            'icon_class' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive'
        ]);

        $feature->update($request->all());

        return redirect()->route('features.index')->with('success', 'Feature updated successfully.');
    }

    public function destroy(Feature $feature)
    {
        $feature->delete();

        return redirect()->route('features.index')->with('success', 'Feature deleted successfully.');
    }
}
