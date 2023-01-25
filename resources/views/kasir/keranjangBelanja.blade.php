@php
    $modal = $total = $keuntungan = 0;
@endphp

@extends('master.master')

@section('title')
    <h3>Keranjang Belanja</h3>
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb" class='breadcrumb-header text-right'>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Kasir</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cart.list', ['sessionName' => 'keranjangBelanja']) }}">Keranjang
                    Belanja</a></li>
        </ol>
    </nav>
@endsection

@section('content')
    <section class="cart">
        <div class="row" id="basic-table">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Table with outer spacing -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>BARANG</th>
                                            <th>JUMLAH</th>
                                            <th>TOTAL</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (session('keranjangBelanja'))
                                            @foreach (session('keranjangBelanja') as $id => $details)
                                                @php
                                                    $total += $details['price'] * $details['quantity'];
                                                    $modal += $details['modal'] * $details['quantity'];
                                                    $keuntungan = $total - $modal;
                                                @endphp
                                                <tr class="" data-id={{ $id }}>
                                                    <th scope="row" class="">
                                                        {{ $details['name'] }}
                                                    </th>
                                                    <td class="">
                                                        <input type="number" class="update-barang quantity"
                                                            value={{ $details['quantity'] }}>
                                                    </td>
                                                    <td class="">
                                                        {{ 'Rp. ' . number_format($details['price'] * $details['quantity']) }}
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-danger btn-sm remove-barang">Hapus</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7" class="text-center">Daftar Barang Kosong</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">
                                                <p class="text-right font-weight-bold">Total</p>
                                            </td>
                                            <td colspan="2">
                                                <p>{{ 'Rp. ' . number_format($total) }}</p>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form action="{{ route('order.store') }}" method="POST">
                            @csrf
                            {{-- total pemasukan - hidden --}}
                            <input type="number" hidden class="form-control" placeholder="0" name="totalPemasukan"
                                id="total-pemasukan" value={{ session('keranjangBelanja') ? $total : 0 }}>
                            {{-- modal - hidden --}}
                            <input type="number" hidden class="form-control" placeholder="0" name="hargaModal" id="harga-modal"
                                value={{ session('keranjangBelanja') ? $modal : 0 }}>
                            {{-- keuntungan - hidden --}}
                            <input type="number" hidden class="form-control" placeholder="0" name="keuntungan" id="keuntungan"
                                value={{ session('keranjangBelanja') ? $keuntungan : 0 }} readonly>
                            <button class="btn btn-primary btn-block" type="submit">Checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(".remove-barang").click(function(e) {
            e.preventDefault();
            var ele = $(this);
            if (confirm("Yakin ingin menghapus item?")) {
                $.ajax({
                    url: "{{ route('removeBarang', 'keranjangBelanja') }}",
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.parents("tr").attr("data-id")
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }
        });

        $(".update-barang").change(function(e) {
            e.preventDefault();
            var ele = $(this);
            $.ajax({
                url: "{{ route('editBarang', ['sessionName' => 'keranjangBelanja', 'type' => 'income']) }}",
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id"),
                    quantity: ele.parents("tr").find(".quantity").val()
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });
    </script>
@endsection
