<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;

class ProductController extends Controller
{
    public function index () {
        $products = Product::get();

        return view('produk.listProduct', ['products' => $products]);
    }

    public function tampilFormTambah () {
        $categories = Category::get();
        $units = Unit::get();

        return view('produk.formTambahProduct', ['categories' => $categories, 'units' => $units]);
    }

    public function store (Request $r) {
        $validated = $r->validate([
            'productName' => 'required',
            'productPrice' => 'required',
            'category_id' => 'required',
            'inStock' => 'required',
            'unit_id' => 'required'
        ]);

        if (!empty($r->input('productModal'))) {
            $validated['productModal'] = $r->productModal;
        }

        $product = Product::create($validated);

        return redirect('/product')->with('Message', 'Berhasil Ditambahkan');
    }

    public function tampilFormEdit($id) {
        $product = Product::where('id',$id)->first();
        $categories = Category::get();
        $units = Unit::get();

        return view('produk.formEditProduct', ['product' => $product, 'categories' => $categories, 'units' => $units]);
    }

    public function patch(Request $r, $id) {
        $validated = $r->validate([
            'productName' => 'required',
            'productPrice' => 'required',
            'category_id' => 'required',
            'inStock' => 'required',
            'unit_id' => 'required'
        ]);

        if (!empty($r->input('productModal'))) {
            $validated['productModal'] = $r->productModal;
        }

        $product = Product::where('id',$id)->update($validated);

        return redirect('/product')->with('Message', 'Berhasil diedit');
    }

    public function delete($id) {
        Product::where('id',$id)->delete();

        return redirect('/product')->with('Message', 'Berhasil dihapus');
    }
}
