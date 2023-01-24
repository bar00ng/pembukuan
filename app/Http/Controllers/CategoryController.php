<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::get();

        return view('listKategori', ['categories' => $categories]);
    }

    public function store(Request $r) {
        $validated = $r->validate([
            'categoryName' => 'required',
        ]);

        $product = Category::create($validated);

        return redirect('/category')->with('Message', 'Berhasil ditambahkan');
    }

    public function patch(Request $r, $id) {
        $validated = $r->validate([
            'categoryName' => 'required',
        ]);

        $category = Category::where('id',$id)->update($validated);

        return redirect('/category')->with('Message', 'Berhasil diedit');
    }

    public function delete($id){
        Category::where('id',$id)->delete();

        return redirect('/category')->with('Message', 'Berhasil dihapus');
    }
}
