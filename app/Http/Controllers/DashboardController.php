<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index() {
        if (Auth::user()->hasRole('admin')) {
            return view('dashboard');
        } elseif (Auth::user()->hasRole('user')) {
            $products = Product::get();
            return view('kasir.dashboard',['products' => $products]);
        }
    }
}
