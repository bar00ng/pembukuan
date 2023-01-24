@php
    $no = 1;
@endphp

@extends('master.master')

@section('title')
    <h3>Daftar Satuan</h3>
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb" class='breadcrumb-header text-right'>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{ route('unit.list') }}">Satuan</a></li>
        </ol>
    </nav>
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#tambah-modal">Tambah</button>

                <div class="modal fade" id="tambah-modal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                        role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Satuan</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form form-vertical" method="POST" action={{ route('unit.store') }}>
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="unitName">Nama Satuan</label>
                                                    <input type="text" id="unitName" class="form-control"
                                                        name="unitName" placeholder="Nama Kategori" required>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class='table table-striped' id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Satuan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @if ($units->isEmpty())
                            <tbody>
                                <tr>
                                    <td colspan="3" class="p-5 italic text-center">Daftar Satuan Kosong</td>
                                </tr>
                            </tbody>
                        @else
                            <tbody>
                                @foreach ($units as $unit)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $unit['unitName'] }}</td>
                                        <td>
                                            <div class="buttons">
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-modal-{{$unit['id']}}">Edit</button>
                                                <div class="modal fade" id="edit-modal-{{ $unit['id'] }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Satuan</h5>
                                                                <button type="button" class="close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action={{ route('unit.patch', ['id' => $unit['id']]) }}>
                                                                    @method('patch')
                                                                    @csrf
                                                                    <div class="form-body">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label for="unitName">Nama Satuan</label>
                                                                                    <input type="text" id="unitName" class="form-control"
                                                                                        name="unitName" placeholder="Nama Kategori"  value={{ $unit['unitName'] }} required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 d-flex justify-content-end">
                                                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#delete-modal-{{ $unit['id'] }}"
                                                    class="btn btn-danger btn-sm">Delete</button>
                                                <div class="modal fade" id="delete-modal-{{ $unit['id'] }}" tabindex="-1"
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
                                                                    <b>{{ $unit['unitName'] }}</b> dari daftar
                                                                    satuan?
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Close</span>
                                                                </button>
                                                                <form
                                                                    action={{ route('unit.delete', ['id' => $unit['id']]) }}
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
