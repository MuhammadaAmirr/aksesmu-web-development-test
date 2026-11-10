<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    // Menampilkan daftar produk
    public function index(): View
    {
        $products = Product::latest()->paginate(10);

        return view('products.index', compact('products'));
    }

    // Menampilkan form tambah produk
    public function create(): View
    {
        return view('products.create');
    }

    // Menyimpan produk baru
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'stock' => 'required|integer|min:0',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    // Menampilkan detail produk
    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }

    // Menampilkan form edit produk
    public function edit(Product $product): View
    {
        return view('products.edit', compact('product'));
    }

    // Memperbarui produk
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'stock' => 'required|integer|min:0',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    // Menghapus produk
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
