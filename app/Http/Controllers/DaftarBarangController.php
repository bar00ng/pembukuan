<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DaftarBarangController extends Controller
{
    // Form Tambah Pemasukan | SESSION_NAME = cart
    // Form Edit Pemasukan | SESSION_NAME = daftarBarang
    // Form Tambah Pengeluaran | SESSION_NAME = daftarPengeluaran
    // Form Edit Pengeluaran | SESSION_NAME = editDaftarPengeluaran
    public function addToSession($sessionName, $id, $type) {
        $product = Product::findOrFail($id);

        $cart = session()->get($sessionName,[]);

        if(isset($cart[$id])) {
            if($cart[$id]['quantity'] + 1 <= $product['inStock'] || $type == 'outcome'){
                $cart[$id]['quantity']++;
            } else {
                return back()->with('Message', 'Stock barang '.$cart[$id]['name'].' hanya tersisa '.$product['inStock']);
            }
        } else {
            $cart[$id] = [
                'name' => $product->productName,
                'quantity' => 1,
                'price' => $product->productPrice,
                'modal' => $product->productModal
            ];
        }

        session()->put($sessionName,$cart);
        return back();
    }

    public function updateFromSession(Request $r, $sessionName, $type) {
        $id = (int)$r->id;
        $product = Product::findOrFail($id);
        
        if($r->id && $r->quantity){
            $cart = session()->get($sessionName);

            if($r->quantity <= $product['inStock'] || $type == 'outcome'){
                $cart[$r->id]["quantity"] = $r->quantity;
            } else {
                session()->flash('Message', 'Stock '.$cart[$id]['name'].' hanya tersisa '.$product['inStock']);
            }
            
            session()->put($sessionName,$cart);
        }
    }

    public function removeFromSession(Request $r, $sessionName) {
        if($r->id) {
            $cart = session()->get($sessionName);
            if(isset($cart[$r->id])) {
                unset($cart[$r->id]);
                session()->put($sessionName, $cart);
            }
            session()->flash('Success', 'Berhasil dihapus');
        }
    }
}
