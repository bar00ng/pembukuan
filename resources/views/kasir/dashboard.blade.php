@extends('master.master')

@section('title')
    <h3>Kasir</h3>
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb" class='breadcrumb-header text-right'>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Kasir</a></li>
        </ol>
    </nav>
@endsection

@section('content')
    <section>
        <div class="row mt-3">
            @if ($products->isEmpty())
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Daftar Produk Kosong</h5>
                        </div>
                    </div>
                </div>
            @else
                @foreach ($products as $product)
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product['productName'] }}</h5>
                                @if ($product['inStock'] == 0)
                                    <h6 class="card-subtitle mb-2 text-danger">Out of Stock</h6>
                                @else
                                    <h6 class="card-subtitle mb-2 text-success">In Stock : {{ $product['inStock'] }}</h6>
                                @endif
                                @if ($product['inStock'] == 0)
                                    <h6 class="card-subtitle mb-2 text-danger" disabled>Out of Stock</h6>
                                @else
                                    <a href={{ route('addBarang', [
                                        'id' => $product['id'],
                                        'sessionName' => 'keranjangBelanja',
                                        'type' => 'income',
                                    ]) }}
                                        class="">
                                        <button class="btn btn-primary btn-sm btn-block mt-2">
                                            <i data-feather="shopping-cart" width="20"></i>
                                            <span class="ml-2">Add to Cart</span>
                                        </button>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>
@endsection
