<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Helpers\ImageHelper;

class PageContentController extends Controller
{
    // Show all pages with their content info
    public function index()
    {
        $pages = Page::all()->keyBy('slug');
        return view('backend.page-content', compact('pages'));
    }

    // Update content for a single page
    public function update(Request $request)
    {
        $page = Page::where('slug', $request->slug)->firstOrFail();
        $page->update([
            'content' => $request->input('content')
        ]);

        return back()->with('success', 'Page content updated successfully!');
    }
}
