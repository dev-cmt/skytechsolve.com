<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\PricePlan;
use App\Models\Setting;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['product', 'plan'])->latest()->paginate(10);
        $statuses = Sale::getStatuses();
        $paymentStatuses = Sale::getPaymentStatuses();

        return view('backend.pages.sales.index', compact('sales', 'statuses', 'paymentStatuses'));
    }

    public function show($id)
    {
        $sale = Sale::with(['product', 'plan'])->findOrFail($id);
        $statuses = Sale::getStatuses();
        $paymentStatuses = Sale::getPaymentStatuses();
        $paymentMethods = Sale::getPaymentMethods();
        $settings = Setting::first();

        return view('backend.pages.sales.show', compact('sale', 'statuses', 'paymentStatuses', 'paymentMethods', 'settings'));
    }

    public function edit($id)
    {
        $sale = Sale::findOrFail($id);
        $products = Product::all();
        $plans = PricePlan::all();
        $statuses = Sale::getStatuses();
        $paymentStatuses = Sale::getPaymentStatuses();
        $paymentMethods = Sale::getPaymentMethods();

        return view('backend.pages.sales.edit', compact('sale', 'products', 'plans', 'statuses', 'paymentStatuses', 'paymentMethods'));
    }

    public function update(Request $request, $id)
    {
        $sale = Sale::findOrFail($id);

        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'product_id' => 'nullable|exists:products,id',
            'plan_id' => 'nullable|exists:price_plans,id',
            'status' => 'required|in:' . implode(',', array_keys(Sale::getStatuses())),
            'payment_status' => 'required|in:' . implode(',', array_keys(Sale::getPaymentStatuses())),
            'payment_method' => 'nullable|in:' . implode(',', array_keys(Sale::getPaymentMethods())),
            'sale_date' => 'nullable|date',
            'expaire_date' => 'nullable|date',
            'price' => 'nullable|numeric|min:0',
            'quantity' => 'nullable|integer|min:1',
            'discount' => 'nullable|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'transaction_id' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'message' => 'nullable|string',
        ]);

        $sale->update($validated);

        return redirect()->route('sales.index')->with('success', 'Sale updated successfully.');
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
