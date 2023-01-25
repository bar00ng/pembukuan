@php
    $modal = $total = $keuntungan = 0;
@endphp

@extends('master.master')

@section('title')
    <h3>Tambah Pemasukan</h3>
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb" class='breadcrumb-header text-right'>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pembukuan.list') }}">Pembukuan</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('pembukuan.tambahPemasukan') }}">Tambah Pemasukan</a></li>
        </ol>
    </nav>
@endsection

@section('content')
    <section class="cart">
        <div class="row" id="basic-table">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Daftar Barang</h4>
                    </div>
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
                                        @if (session('cart'))
                                            @foreach (session('cart') as $id => $details)
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
                                        <tr class="">
                                            <td colspan="7">
                                                <button type="button" class="btn btn-primary btn-block"
                                                    data-bs-toggle="modal" data-bs-target="#produk-modal">Tambah
                                                    Barang</button>

                                                <div class="modal fade" id="produk-modal" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Daftar
                                                                    Barang</h5>
                                                                <button type="button" class="close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="table-responsive">
                                                                    <table class="table mb-0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>PRODUCT NAME</th>
                                                                                <th>ACTION</th>
                                                                            </tr>
                                                                        </thead>
                                                                        @if ($products->isEmpty())
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td colspan="2" class="text-center">
                                                                                        Daftar Produk Kosong</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        @else
                                                                            <tbody>
                                                                                @foreach ($products as $product)
                                                                                    <tr>
                                                                                        <td>{{ $product['productName'] }}
                                                                                        </td>
                                                                                        <td>
                                                                                            <a href={{ route('addBarang', [
                                                                                                'id' => $product['id'],
                                                                                                'sessionName' => 'cart',
                                                                                                'type' => 'income',
                                                                                            ]) }}
                                                                                                class="btn btn-success btn-sm">
                                                                                                Add
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        @endif
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action={{ route('income.store') }} method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Total Pemasukan</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                                </div>
                                                <input type="number" class="form-control" placeholder="0"
                                                    name="totalPemasukan" id="total-pemasukan"
                                                    value={{ session('cart') ? $total : 0 }}>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Harga Modal</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                            </div>
                                            <input type="number" class="form-control" placeholder="0" name="hargaModal"
                                                id="harga-modal" value={{ session('cart') ? $modal : 0 }}>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Keuntungan</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                            </div>
                                            <input type="number" class="form-control" placeholder="0" name="keuntungan"
                                                id="keuntungan" value={{ session('cart') ? $keuntungan : 0 }} readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <div class="form-check">
                                            <input class="" type="radio" name="status" id="" checked value=1 >
                                            <label class="" for="">
                                                Lunas
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="" type="radio" name="status" id="" value=0>
                                            <label class="" for="">
                                                Tidak Lunas
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Catatan</label>
                                        <textarea class="form-control" id="" placeholder="Opsional" name="description" rows="3"></textarea>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1 btn-block">Submit</button>
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

@section('script')
    <script>
        function hitungKeuntungan() {
            var pendapatan = $('#total-pemasukan').val();
            var modal = $('#harga-modal').val();
            var keuntungan = pendapatan - modal;

            $('#keuntungan').val(keuntungan);
        }

        $(".remove-barang").click(function(e) {
            e.preventDefault();
            var ele = $(this);
            if (confirm("Yakin ingin menghapus item?")) {
                $.ajax({
                    url: "{{ route('removeBarang', 'cart') }}",
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
                url: "{{ route('editBarang', ['sessionName' => 'cart', 'type' => 'income']) }}",
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

        $('#total-pemasukan').change(function(e) {
            e.preventDefault();

            hitungKeuntungan();
        });

        $('#harga-modal').change(function(e) {
            e.preventDefault();

            hitungKeuntungan();
        });
    </script>
@endsection
