<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::where('is_active', true)
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->get();

        return view('products.index', compact('products'));
    }

    public function subscribe(Request $request, Product $product): RedirectResponse
    {
        abort_unless($product->is_active, 404);

        if (! $request->user()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mengajukan langganan.');
        }

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:500'],
            'payment_proof' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
        ]);

        $paymentProofPath = $request->file('payment_proof')->store('payment-proofs', 'public');
        unset($validated['payment_proof']);

        $request->user()->subscriptions()->create([
            'product_id' => $product->id,
            'status' => 'pending',
            'payment_proof_path' => $paymentProofPath,
            ...$validated,
        ]);

        return redirect()->route('subscriptions.create')->with('success', "Pengajuan langganan paket {$product->name} berhasil dikirim.");
    }
}
