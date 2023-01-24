@php
    $no = 1;
@endphp

@extends('master.master')

@section('title')
    <h3>Daftar Produk</h3>
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb" class='breadcrumb-header text-right'>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{ route('product.list') }}">Produk</a></li>
        </ol>
    </nav>
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <a href={{ route('product.form.tambah') }}>
                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                data-bs-target="#tambah-modal">Tambah</button>
            </a>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Modal</th>
                            <th>Kategori</th>
                            <th>Stock</th>
                            <th>Satuan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @if ($products->isEmpty())
                        <tbody>
                            <tr>
                                <td colspan="10" class="p-5 italic text-center">Daftar Produk Kosong</td>
                            </tr>
                        </tbody>
                    @else
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $product['productName'] }}</td>
                                    <td>{{ 'Rp. '.number_format($product['productPrice']) }}</td>
                                    <td>{{ 'Rp. '.number_format($product['productModal']) }}</td>
                                    <td>{{ $product->category->categoryName }}</td>
                                    <td>{{ $product['inStock'] }}</td>
                                    <td>{{ $product->unit->unitName }}</td>
                                    <td>
                                        <div class="buttons">
                                            <a href="{{ route('product.form.edit', ['id' => $product['id']]) }}">
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-modal-{{$product['id']}}">Edit</button>
                                            </a>

                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#delete-modal-{{ $product['id'] }}"
                                                class="btn btn-danger btn-sm">Delete</button>
                                            <div class="modal fade" id="delete-modal-{{ $product['id'] }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Delete
                                                                Confirmation</h5>
                                                            <button type="button" class="close"
                                                                data-bs-dismiss="modal" aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>
                                                                Apa anda yakin ingin menghapus
                                                                <b>{{ $product['productName'] }}</b> dari daftar barang?
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>
                                                            <form
                                                                action={{ route('product.delete', ['id' => $product['id']]) }}
                                                                method="post" class="inline-flex items-center">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger ml-1"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Delete</span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif
                </table>
            </div>
        </div>

</section>
@endsection