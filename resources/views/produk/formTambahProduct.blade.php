@php
    $no = 1;
@endphp

@extends('master.master')

@section('title')
    <h3>Tambah Produk</h3>
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb" class='breadcrumb-header text-right'>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('product.list') }}">Produk</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('product.form.tambah') }}">Tambah Product</a></li>
        </ol>
    </nav>
@endsection

@section('content')
    <section class="section">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action={{ route('product.store') }}>
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Nama Barang</label>
                                            <input type="text" id=""
                                                class="form-control {{ $errors->first('productName') ? 'is-invalid' : '' }}"
                                                placeholder="Nama Barang" name="productName" required
                                                value="{{ old('productName') }}">
                                            @if ($errors->first('productName'))
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    {{ $errors->first('productName') }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Harga Jual</label>
                                        <input type="number" name="productPrice"
                                            class="form-control {{ $errors->first('productPrice') ? 'is-invalid' : '' }}"
                                            placeholder="0" value={{ old('productPrice') }} required>
                                        @if ($errors->first('productPrice'))
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $errors->first('productPrice') }}
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Harga Modal (Tidak Wajib)</label>
                                        <input type="number" id=""
                                            class="form-control {{ $errors->first('productModal') ? 'is-invalid' : '' }}"
                                            placeholder="0" name="productModal" value={{ old('productModal') }}>
                                        @if ($errors->first('productModal'))
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $errors->first('productModal') }}
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Kategori</label>
                                        <fieldset class="form-group">
                                            <select class="form-select" id="" name="category_id">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id') == $category->id ? ' selected' : ' ' }}>
                                                        {{ $category->categoryName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Stock Barang</label>
                                        <input type="number" placeholder="0" id=""
                                            class="form-control {{ $errors->first('inStock') ? 'is-invalid' : '' }}"
                                            name="inStock" placeholder="0" required value={{ old('inStock') }}>
                                        @if ($errors->first('inStock'))
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $errors->first('inStock') }}
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Satuan</label>
                                        <fieldset class="form-group">
                                            <select class="form-select" id="" name="unit_id">
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit->id }}"
                                                        {{ old('unit_id') == $unit->id ? ' selected' : ' ' }}>
                                                        {{ $unit->unitName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
