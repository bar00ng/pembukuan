<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Entry;
use Carbon\Carbon;
use App\Charts\Pembukuan;

class PembukuanController extends Controller
{
    public function index() {
        $data = Entry::orderBy('created_at', 'DESC')
            ->get()
            ->groupBy(function ($val) {
                return Carbon::parse($val->created_at)->format('d M Y');
            });

        $pembukuan = Entry::orderBy('created_at')
            ->get()
            ->groupBy(function ($val) {
                return Carbon::parse($val->created_at)->format('M Y');
            });

        $money = Entry::select('totalPemasukan', 'hargaModal')
            ->get();

        $months = [];
        $pemasukan = [];
        $pengeluaran = [];

        foreach($pembukuan as $month => $values){
            $months[] = $month;
            $pemasukan[] = $values->sum('totalPemasukan');
            $pengeluaran[] = $values->sum('hargaModal');
        }

        $chart = new Pembukuan;

        $chart->labels($months);
        $chart->dataset('Pemasukan', 'line', $pemasukan)->color('#046c4e');
        $chart->dataset('Pengeluaran', 'line', $pengeluaran)->color('#c81e1e');
        
        return view('listPembukuan',[
            'data' => $data,
            'chart' => $chart,
            'money' => $money
        ]);
    }

    public function delete($id){
        Entry::where('id', $id)->delete();

        return redirect('/pembukuan')->with('Message', 'Berhasil dihapus');
    }

    public function formAddPemasukan() {
        $products = Product::get();

        return view('pemasukan.formTambahPemasukan', [
            'products' => $products
        ]);
    }

    public function formAddPengeluaran() {
        $products = Product::get();

        return view('pengeluaran.formTambahPengeluaran', [
            'products' => $products
        ]);
    }

    public function formEditPemasukan($id) {
        $data = Entry::where('id', $id)->first();
        $products = Product::get();

        $session = session()->get('daftarBarang'.$id, []);
        $tmp_session = session()->get('daftarBarangBefore'.$id, []);
        
        if(!session('daftarBarang'.$id)) {
            session()->put('daftarBarang'.$id, $data['details']);
            session()->put('daftarBarangBefore'.$id, $data['details']);
        }

        return view('pemasukan.formEditPemasukan', [
            'data' => $data,
            'products' => $products
        ]);
    }

    public function formEditPengeluaran($id) {
        $data = Entry::where('id', $id)->first();
        $products = Product::get();

        $session = session()->get('editDaftarPengeluaran'.$id, []);
        $tmp_session = session()->get('editDaftarPengeluaranBefore'.$id, []);
        
        if(!session('editDaftarPengeluaran'.$id)) {
            session()->put('editDaftarPengeluaran'.$id, $data['details']);
            session()->put('editDaftarPengeluaranBefore'.$id, $data['details']);
        }

        return view('pengeluaran.formEditPengeluaran', [
            'data' => $data,
            'products' => $products
        ]);
    }

}
