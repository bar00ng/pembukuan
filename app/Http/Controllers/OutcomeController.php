<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Entry;
use Carbon\Carbon;

class OutcomeController extends Controller
{
    public function store(Request $r) {
        $cart = session()->get('daftarPengeluaran');
        $productId = array_keys($cart);
       
        $validated = $r->validate([
            'hargaModal' => 'required',
        ]);
        if (!empty($r->input('description'))) {
            $validated['description'] = $r->description;
        }
        if (session('daftarPengeluaran')) {
            $validated['details'] = $cart;
        }
        $validated['status'] = $r->status;
        $validated['isPemasukan'] = 0;
        $validated['totalPemasukan'] = 0;
        $validated['keuntungan'] = 0;

        Entry::create($validated);
        foreach($productId as $id){
            $product = Product::where('id', $id)->first();

            Product::where('id',$id)->update([
                'inStock' => $product['inStock'] + $cart[$id]['quantity']
            ]);
        }

        session()->forget('daftarPengeluaran');
        return redirect('/pembukuan')->with('Message', 'Berhasil dimasukkan');
    }

    public function patch(Request $r, $id) {
        $cart = session()->get('editDaftarPengeluaran'.$id);
        $productId = array_keys($cart);

        $tmp_cart = session()->get('editDaftarPengeluaranBefore'.$id);
        $tmp_productId = array_keys($tmp_cart);
       
        $validated = $r->validate([
            'hargaModal' => 'required',
        ]);
        if (!empty($r->input('description'))) {
            $validated['description'] = $r->description;
        }
        if (session('editDaftarPengeluaran'.$id)) {
            $validated['details'] = $cart;
        }
        $validated['status'] = $r->status;

        Entry::where('id',$id)->update($validated);
        
        // Restore Stock
        foreach ($tmp_productId as $id) {
            $product = Product::where('id', $id)->first();

            Product::where('id',$id)->update([
                'inStock' => $product['inStock'] - $tmp_cart[$id]['quantity']
            ]);
        }

        // Add Stock
        foreach($productId as $id){
            $product = Product::where('id', $id)->first();

            Product::where('id',$id)->update([
                'inStock' => $product['inStock'] + $cart[$id]['quantity']
            ]);
        }

        $r->session()->forget('editDaftarPengeluaran'.$id);
        $r->session()->forget('editDaftarPengeluaranBefore'.$id);
        return redirect('/pembukuan')->with('Message', 'Berhasil diedit');
    }
}
