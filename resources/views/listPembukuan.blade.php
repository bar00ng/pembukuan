@php
    $keuntungan = 0;
    $pengeluaran = 0;
@endphp

@foreach ($money as $m)
    @php
        $keuntungan += $m['totalPemasukan'];
        $pengeluaran += $m['hargaModal'];
    @endphp
@endforeach

@extends('master.master')

@section('title')
    <h3>Pembukuan</h3>
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb" class='breadcrumb-header text-right'>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{ route('pembukuan.list') }}">Pembukuan</a></li>
        </ol>
    </nav>
@endsection

@section('content')
    <section class="chart">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Grafik</h4>
                    </div>
                    <div class="card-body">
                        {!! $chart->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pembukuan-table">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Daftar Pembukuan</h4>

                <a href={{ route('pembukuan.tambahPemasukan') }}>
                    <button type="button"
                        class="btn btn-success">+
                        Pemasukan</button>
                </a>

                <a href={{ route('pembukuan.tambahPengeluaran') }}>
                    <button type="button"
                        class="btn btn-danger">+
                        Pengeluaran</button>
                </a>
            </div>
            <div class="card-body table-responsive h-25">
                <table class='table mh-50' id="table1">
                    <thead>
                        <tr>
                            <th>Catatan</th>
                            <th>Pemasukan</th>
                            <th>Pengeluaran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @if ($data->isEmpty())
                        <tbody>
                            <tr>
                                <td colspan="10" class="p-5 italic text-center">Daftar Produk Kosong</td>
                            </tr>
                        </tbody>
                    @else
                        <tbody>
                            @foreach ($data as $day => $data_list)
                                <tr>
                                    <td colspan="10" class="bg-dark text-white text-uppercase">
                                        {{ $day }}
                                    </td>
                                </tr>
                                @foreach ($data_list as $d)
                                    <tr>
                                        <th>
                                            @if ($d->description > 1)
                                                <p>{{ $d->description }}</p>
                                            @else
                                                <p>-</p>
                                            @endif

                                            @if ($d->isPemasukan > 0)
                                                <p class="text-success">Pemasukan</p>
                                            @else
                                                <p class="text-danger">Pengeluaran</p>
                                            @endif
                                        </th>
                                        <td class="text-success">{{ 'Rp. ' . number_format($d->totalPemasukan) }}</td>
                                        <td class="text-danger">{{ 'Rp. ' . number_format($d->hargaModal) }}</td>
                                        <td>
                                            @if ($d->isPemasukan == 1)
                                                <a href={{ route('pembukuan.editPemasukan', ['id' => $d->id]) }}
                                                    class="btn btn-warning btn-sm">Edit</a>
                                            @else
                                                <a href={{ route('pembukuan.editPengeluaran', ['id' => $d->id]) }}
                                                    class="btn btn-warning btn-sm">Edit</a>
                                            @endif

                                            <button class="btn btn-danger btn-sm" type="button"
                                                data-bs-toggle="modal" data-bs-target="#delete-modal-{{ $d->id }}">Hapus</button>
                                            <div class="modal fade" id="delete-modal-{{ $d->id }}" tabindex="-1"
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
                                                                Apa anda yakin ingin menghapus item dari daftar
                                                                pembukuan?
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>
                                                            <form
                                                                action={{ route('pembukuan.delete', ['id' => $d['id']]) }}
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
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    @endif
                </table>
            </div>
        </div>

    </section>
@endsection

@section('script')
    {!! $chart->script() !!}
@endsection
