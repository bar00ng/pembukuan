<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PembukuanController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\OutcomeController;
use App\Http\Controllers\DaftarBarangController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/product',[ProductController::class, 'index'])->name('product.list');
Route::get('/productAddForm', [ProductController::class, 'tampilFormTambah'])->name('product.form.tambah');
Route::post('/product',[ProductController::class, 'store'])->name('product.store');
Route::get('/productEditForm/{id}', [ProductController::class, 'tampilFormEdit'])->name('product.form.edit');
Route::patch('/product/{id}',[ProductController::class, 'patch'])->name('product.patch');
Route::delete('/product/{id}',[ProductController::class, 'delete'])->name('product.delete');

Route::get('/unit',[UnitController::class, 'index'])->name('unit.list');
Route::post('/unit',[UnitController::class, 'store'])->name('unit.store');
Route::patch('/unit/{id}',[UnitController::class, 'patch'])->name('unit.patch');
Route::delete('/unit/{id}',[UnitController::class, 'delete'])->name('unit.delete');

Route::get('/category',[CategoryController::class, 'index'])->name('category.list');
Route::post('/category',[CategoryController::class, 'store'])->name('category.store');
Route::patch('/category/{id}',[CategoryController::class, 'patch'])->name('category.patch');
Route::delete('/category/{id}',[CategoryController::class, 'delete'])->name('category.delete');

Route::get('/pembukuan',[PembukuanController::class,'index'])->name('pembukuan.list');
Route::delete('/pembukuan/{id}', [PembukuanController::class, 'delete'])->name('pembukuan.delete');

Route::get('/pembukuan/add/pemasukan',[PembukuanController::class, 'formAddPemasukan'])->name('pembukuan.tambahPemasukan');
Route::post('/pembukuan/add/pemasukan',[IncomeController::class, 'store'])->name('income.store');
Route::get('/pembukuan/edit/pemasukan/{id}',[PembukuanController::class, 'formEditPemasukan'])->name('pembukuan.editPemasukan');
Route::patch('/pembukuan/edit/pemasukan/{id}', [IncomeController::class, 'patch'])->name('income.patch');

Route::get('/pembukuan/add/pengeluaran',[PembukuanController::class, 'formAddPengeluaran'])->name('pembukuan.tambahPengeluaran');
Route::post('/pembukuan/add/pengeluaran',[OutcomeController::class, 'store'])->name('outcome.store');
Route::get('/pembukuan/edit/pengeluaran/{id}',[PembukuanController::class, 'formEditPengeluaran'])->name('pembukuan.editPengeluaran');
Route::patch('/pembukuan/edit/pengeluaran/{id}', [OutcomeController::class, 'patch'])->name('outcome.patch');

Route::get('/addBarang/{sessionName}/{id}/{type?}', [DaftarBarangController::class, 'addToSession'])->name('addBarang');
Route::delete('/deleteBarang/{sessionName}',[DaftarBarangController::class, 'removeFromSession'])->name('removeBarang');
Route::patch('/editBarang/{sessionName}/{type?}', [DaftarBarangController::class, 'updateFromSession'])->name('editBarang');

require __DIR__.'/auth.php';
