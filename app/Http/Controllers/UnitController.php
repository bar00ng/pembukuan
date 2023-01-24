<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;

class UnitController extends Controller
{
    public function index() {
        $units = Unit::get();

        return view('listUnit', ['units' => $units]);
    }

    public function store(Request $r) {
        $validated = $r->validate([
            'unitName' => 'required'
        ]);

        $unit = Unit::create($validated);

        return redirect('/unit')->with('Message','Berhasil ditambahkan');
    }

    public function patch(Request $r, $id) {
        $validated = $r->validate([
            'unitName' => 'required'
        ]);

        $unit = Unit::where('id',$id)->update($validated);

        return redirect('/unit')->with('Message', 'Berhasil diedit');
    }

    public function delete($id) {
        Unit::where('id',$id)->delete();

        return redirect('/unit')->with('Message', 'Berhasil dihapus');
    }
}
