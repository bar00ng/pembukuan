<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entry;
use App\Models\Product;

class IncomeController extends Controller
{
    public function store(Request $r){
        $cart = session()->get('cart');
       
        $validated = $r->validate([
            'totalPemasukan' => 'required',
            'hargaModal' => 'required',
            'keuntungan' => 'required',
        ]);
        if (!empty($r->input('description'))) {
            $validated['description'] = $r->description;
        }
        if (session('cart')) {
            $validated['details'] = $cart;
            $productId = array_keys($cart);
            foreach($productId as $id){
                $product = Product::where('id', $id)->first();
    
                Product::where('id',$id)->update([
                    'inStock' => $product['inStock'] - $cart[$id]['quantity']
                ]);
            }
        }
        $validated['status'] = $r->status;
        $validated['isPemasukan'] = 1;

        Entry::create($validated);

        $r->session()->forget('cart');
        return redirect('/pembukuan')->with('Message', 'Berhasil dimasukkan');
    }

    public function patch(Request $r, $id){
        $cart = session()->get('daftarBarang'.$id);
        $productId = array_keys($cart);
       
        $tmp_cart = session()->get('daftarBarangBefore'.$id);
        $tmp_productId = array_keys($tmp_cart);

        $validated = $r->validate([
            'totalPemasukan' => 'required',
            'hargaModal' => 'required',
            'keuntungan' => 'required',
        ]);
        if (!empty($r->input('description'))) {
            $validated['description'] = $r->description;
        }
        if (session('cart')) {
            $validated['details'] = $cart;
        }
        $validated['status'] = $r->status;

        Entry::where('id',$id)->update($validated);

        // Restore Stock
        foreach ($tmp_productId as $id) {
            $product = Product::where('id', $id)->first();

            Product::where('id',$id)->update([
                'inStock' => $product['inStock'] + $tmp_cart[$id]['quantity']
            ]);
        }
    
        // Reduce Stock
        foreach($productId as $id){
            $product = Product::where('id', $id)->first();

            Product::where('id',$id)->update([
                'inStock' => $product['inStock'] - $cart[$id]['quantity']
            ]);
        }

        $r->session()->forget('daftarBarang'.$id);
        $r->session()->forget('daftarBarangBefore'.$id);
        return redirect('/pembukuan')->with('Message', 'Berhasil diedit');
    }
}
