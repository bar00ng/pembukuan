<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entry;
use App\Models\Product;

class OrderController extends Controller
{
    public function index() {
        $data = Entry::where('isOrder',1)->get();

        return view('kasir.listOrder',['data' => $data]);
    }

    public function editForm($id) {
        $data = Entry::where('id', $id)->first();
        $products = Product::get();

        $session = session()->get('AnotherCart'.$id, []);
        $tmp_session = session()->get('AnotherCartBefore'.$id, []);
        
        if(!session('AnotherCart'.$id)) {
            session()->put('AnotherCart'.$id, $data['details']);
            session()->put('AnotherCartBefore'.$id, $data['details']);
        }

        return view('kasir.formEditOrder', [
            'data' => $data,
            'products' => $products
        ]);
    }

    public function delete($id) {
        Entry::where('id', $id)->delete();

        return redirect('/order')->with('Message', 'Order berhasil dihapus');
    }

    public function patch(Request $r, $id) {
        $cart = session()->get('AnotherCart'.$id);
        $productId = array_keys($cart);
       
        $tmp_cart = session()->get('AnotherCartBefore'.$id);
        $tmp_productId = array_keys($tmp_cart);

        $validated = $r->validate([
            'totalPemasukan' => 'required',
            'hargaModal' => 'required',
            'keuntungan' => 'required',
        ]);
        if (!empty($r->input('description'))) {
            $validated['description'] = $r->description;
        }
        if (session('AnotherCart'.$id)) {
            $validated['details'] = $cart;
        }

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

        $r->session()->forget('AnotherCart'.$id);
        $r->session()->forget('AnotherCartBefore'.$id);
        return redirect('/order')->with('Message', 'Berhasil diedit');
    }

    public function store(Request $r) {
        $cart = session()->get('keranjangBelanja');
       
        $validated = $r->validate([
            'totalPemasukan' => 'required',
            'hargaModal' => 'required',
            'keuntungan' => 'required',
        ]);

        if (!empty($r->input('description'))) {
            $validated['description'] = $r->description;
        }

        if (session('keranjangBelanja')) {
            $validated['details'] = $cart;
            $productId = array_keys($cart);
            foreach($productId as $id){
                $product = Product::where('id', $id)->first();
    
                Product::where('id',$id)->update([
                    'inStock' => $product['inStock'] - $cart[$id]['quantity']
                ]);
            }
        }
        $validated['status'] = 1;
        $validated['isPemasukan'] = 1;
        $validated['isOrder'] = 1;

        Entry::create($validated);

        $r->session()->forget('keranjangBelanja');
        return redirect('/dashboard')->with('Message', 'Berhasil memesan');
    }
}
