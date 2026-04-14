<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['product', 'plan'])->latest()->paginate(10);
        $statuses = Sale::getStatuses();

        return view('backend.pages.sales.index', compact('sales', 'statuses'));
    }

    public function show($id)
    {
        $sale = Sale::with(['product', 'plan'])->findOrFail($id);
        $statuses = Sale::getStatuses();

        return view('backend.pages.sales.show', compact('sale', 'statuses'));
    }

    public function updateStatus(Request $request, $id)
    {
        $sale = Sale::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:' . implode(',', array_keys(Sale::getStatuses())),
        ]);

        $sale->update(['status' => $validated['status']]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully.',
                'status' => $validated['status'],
                'status_label' => Sale::getStatuses()[$validated['status']],
            ]);
        }

        return redirect()->route('sales.index')->with('success', 'Sale status updated successfully.');
    }

    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->delete();

        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }
}
