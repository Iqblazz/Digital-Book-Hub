<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

class ProductController extends Controller
{
    /**
     * Index Product.
     */
    public function index()
    {
        // Ambil semua data produk dan kembalikan sebagai JSON
        return response()->json(Product::all());
    }

    /**
     * Product.Store.
     */
    public function store(Request $request)
    {
        // Validasi input sesuai kolom di migrasi kamu
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        // Simpan ke database
        $product = Product::create($validated);

        return response()->json($product, 201);
    }

    /**
     * Products.Show.
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Products.Update.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'price' => 'sometimes|required|integer',
            'stock' => 'sometimes|required|integer',
        ]);

        $product->update($validated);

        return response()->json($product->refresh());
    }

    /**
     * Products.Destroy.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Produk berhasil dihapus']);
    }
}