<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use Wavey\Sweetalert\Sweetalert;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Discount;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Products";
        $products = Product::with(['category', 'discount'])->paginate(10);;
        return view('dashboard.products.index', compact('title', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Products";
        $categories = Category::all();
        $discounts = Discount::all();
        return view('dashboard.products.create', compact('title', 'categories', 'discounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $productDetail = $request->validate([
            'name_product' => 'required|min:3',
            'barcode' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'discount_id' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required',
            'expired_at' => 'nullable|date',
            'product_img' => 'required|mimes:png,jpg|max:2048',
        ]);

        // upload image products
        $imageName = str_replace(' ', '-', $productDetail['name_product']) . '-' . date('dmyHis') . '.' . $request->file('product_img')->extension();
        Storage::putFileAs('static/images/products', $request->file('product_img'), $imageName);

        $dataProduk = [
            'name' => $productDetail['name_product'],
            'barcode' => $productDetail['barcode'],
            'category_id' => $productDetail['category_id'],
            'price' => $productDetail['price'],
            'stock' => $productDetail['stock'],
            'image_url' => $imageName
        ];

        if($productDetail['discount_id'] != null) {
            $dataProduk['discount_id'] = $productDetail['discount_id'];
        }

        if($productDetail['expired_at'] != null) {
            $dataProduk['expired_at'] = $productDetail['expired_at'];
        }

        Product::create($dataProduk);

        Sweetalert::success('berhasil menabah produk baru', 'Tambah Produk Berhasil!');
        return redirect()->route('dashboard.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $title = "Edit Products";
        $categories = Category::all();
        $discounts = Discount::all();
        return view('dashboard.products.edit', compact('title', 'product', 'categories', 'discounts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $productDetail = $request->validate([
            'name_product' => 'required|min:3',
            'barcode' => 'nullable',
            'category_id' => 'required|numeric|exists:categories,id',
            'discount_id' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required',
            'expired_at' => 'nullable|date',
            'product_img' => 'required|mimes:png,jpg|max:2048',
        ]);

        $product->name = $productDetail['name_product'];
        $product->barcode = $productDetail['barcode'];
        $product->category_id = $productDetail['category_id'];
        $product->price = $productDetail['price'];
        $product->stock = $productDetail['stock'];

        if($request->file('product_img')) {
            // delete old image
            if($product->image_url != null) {
                Storage::delete('static/images/products/' . $product->image_url);
            }

            // store new image
            // upload image products
            $imageName = str_replace(' ', '-', $productDetail['name_product']) . '-' . date('dmyHis') . '.' . $request->file('product_img')->extension();
            Storage::putFileAs('static/images/products', $request->file('product_img'), $imageName);
            $product->image_url = $imageName;
        }

        if($productDetail['discount_id'] != null) {
            $product->discount_id = $productDetail['discount_id'];
        }

        if($productDetail['expired_at'] != null) {
            $product->expired_at = $productDetail['expired_at'];
        }

        $product->save();

        Sweetalert::success('berhasil menabah produk baru', 'Tambah Produk Berhasil!');
        return redirect()->route('dashboard.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Storage::delete('static/images/products/' . $product->image_url);
        $product->delete();

        Sweetalert::success('berhasil menghapus produk ' . $product->name, 'Hapus Berhasil');
        return back();
    }
}
