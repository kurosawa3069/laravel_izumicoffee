<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // 公開中の商品だけを取得（将来の拡張を考慮）
        // $products = Product::where('is_active', true)
        //     ->orderBy('created_at', 'desc')
        //     ->get();

        $products = Product::where('is_online_shop', true)
                ->orderBy('created_at', 'desc')
                ->get();

        return view('products.index', [
            'products' => $products,
        ]);
    }

    // public function index()
    // {
    //     return view('products.index');
    // }

    // public function show(Product $product)
    // {
    //     // 非公開・売り切れ商品の制御（必要に応じて）
    //     if (! $product->is_active) {
    //         abort(404);
    //     }

    //     return view('products.show', [
    //         'product' => $product,
    //     ]);
    // }    
    
    // public function show(string $id)
    // {
    //     $product = Product::findOrFail($id);
    //     return view('products.show', compact('product'));
    // }

    // public function show()
    // {
    //     return view('products.show');
    // }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
