<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.products.index', [
            'products' => $products,
        ]);
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
            
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
            'is_sold_out' => 'required|boolean',
        ]);

        $fileNameToProduct = null;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $imageFile = $request->file('image');

            // ファイル名生成
            $fileName = uniqid() . '_' . time();
            $extension = $imageFile->getClientOriginalExtension();
            $fileNameToProduct = $fileName . '.' . $extension;

            // ImageManager（v3）
            $manager = new ImageManager(new Driver());

            $image = $manager
                ->read($imageFile)
                ->resize(1920, 1080);

            // 保存（public/storage）
            Storage::disk('public')->put(
                'product/' . $fileNameToProduct,
                (string) $image->encode()
            );
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $fileNameToProduct,
            'is_new' => (int)$request->input('is_new', 0),
            'is_sold_out' => (int)$request->input('is_sold_out', 0),
            'is_active' => (int)$request->input('is_active', 0),
        ]);

        return redirect()->route('admin.products.index');
    }

    public function show(string $id)
    {
        $products = Product::where('is_active', true)
        ->orderBy('created_at', 'desc')
        ->get();

        return view('admin.products.show', [
            'products' => $products,
        ]);
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
            'is_sold_out' => 'required|boolean',
        ]);

        // 既存画像を初期値として保持
        $fileNameToProduct = $product->image;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $imageFile = $request->file('image');

            // ファイル名生成
            $fileName = uniqid() . '_' . time();
            $extension = $imageFile->getClientOriginalExtension();
            $fileNameToProduct = $fileName . '.' . $extension;

            // ImageManager（v3）
            $manager = new ImageManager(new Driver());

            $image = $manager
                ->read($imageFile)
                ->resize(1920, 1080);

            // 保存（public/storage）
            Storage::disk('public')->put(
                'product/' . $fileNameToProduct,
                (string) $image->encode()
            );

            // 旧画像があれば削除
            if ($product->image) {
                Storage::disk('public')->delete('product/' . $product->image);
            }
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $fileNameToProduct,
            'is_new' => (int) $request->input('is_new', 0),
            'is_sold_out' => (int) $request->input('is_sold_out', 0),
            'is_active' => (int) $request->input('is_active', 0),
        ]);

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
