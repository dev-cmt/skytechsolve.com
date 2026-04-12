<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // For simplicity, let's allow admins to see all and users to see their own if we had multi-user logic. 
        // But based on UserController, it seems like an admin panel. 
        // I will show all sites for now, or filter by user if Auth::user() is available.
        $sites = Site::with('user')->latest()->get();
        return view('backend.sites.index', compact('sites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'alert_email' => 'nullable|email|max:255',
        ]);

        Site::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'url' => $request->url,
            'alert_email' => $request->alert_email,
        ]);

        return redirect()->back()->with('success', 'Site added for monitoring successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:sites,id',
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'alert_email' => 'nullable|email|max:255',
        ]);

        $site = Site::findOrFail($request->id);
        $site->update([
            'name' => $request->name,
            'url' => $request->url,
            'alert_email' => $request->alert_email,
        ]);

        return redirect()->back()->with('success', 'Site updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $site = Site::findOrFail($id);
        $site->delete();

        return redirect()->back()->with('success', 'Site removed from monitoring.');
    }

    /**
     * Toggle the is_down_notified status.
     */
    public function toggleNotified(Request $request)
    {
        $site = Site::findOrFail($request->id);
        $site->update(['is_down_notified' => $request->is_down_notified]);

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }
}
