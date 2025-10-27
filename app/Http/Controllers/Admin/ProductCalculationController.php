<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Cache;

class ProductCalculationController extends Controller
{
    public function productCalculation(Request $request)
    {
        // Read current calculation config from session (defaults inside model)
        $cfg = [
            'markup_percent' => session('calc.markup_percent', 100.0),
            'affiliate_percent' => session('calc.affiliate_percent', 30.0),
            'tax_percent' => session('calc.tax_percent', 6.0),
            'shipping_percent' => session('calc.shipping_percent', 30.0),
            'processing_percent' => session('calc.processing_percent', 5.0),
            'maintenance_percent' => session('calc.maintenance_percent', 35.0),
        ];

        // Load products with their category (no breakdown on model side)
        $product = Product::with('categorys')->paginate(15);

        return view('admin.product.product-calculation', compact('product', 'cfg'));
    }

    /**
     * Save calculation config (percentages) into session so it applies instantly.
     */
    public function saveProductCalculation(Request $request)
    {
        $data = $request->validate([
            'markup_percent' => 'nullable|numeric',
            'affiliate_percent' => 'nullable|numeric',
            'tax_percent' => 'nullable|numeric',
            'shipping_percent' => 'nullable|numeric',
            'processing_percent' => 'nullable|numeric',
            'maintenance_percent' => 'nullable|numeric',
        ]);

        // Save into session under 'calc' namespace (admin preview)
        $calc = [
            'markup_percent' => $data['markup_percent'] ?? 100.0,
            'affiliate_percent' => $data['affiliate_percent'] ?? 30.0,
            'tax_percent' => $data['tax_percent'] ?? 6.0,
            'shipping_percent' => $data['shipping_percent'] ?? 30.0,
            'processing_percent' => $data['processing_percent'] ?? 5.0,
            'maintenance_percent' => $data['maintenance_percent'] ?? 35.0,
        ];

        session([
            'calc.markup_percent' => $calc['markup_percent'],
            'calc.affiliate_percent' => $calc['affiliate_percent'],
            'calc.tax_percent' => $calc['tax_percent'],
            'calc.shipping_percent' => $calc['shipping_percent'],
            'calc.processing_percent' => $calc['processing_percent'],
            'calc.maintenance_percent' => $calc['maintenance_percent'],
        ]);

        // Persist globally via cache so changes apply site-wide (not just admin session)
        try {
            Cache::forever('calc', $calc);
        } catch (\Exception $e) {
            // If cache backend isn't available, ignore and continue (session still works)
        }

    return redirect()->route('product.calculation')->with('success', 'Calculation settings saved.');
    }
}
