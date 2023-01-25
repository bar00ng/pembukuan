@php
    $no = 1;
@endphp

@extends('master.master')

@section('title')
    <h3>Daftar Order</h3>
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb" class='breadcrumb-header text-right'>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{ route('order.list') }}">Daftar Order</a></li>
        </ol>
    </nav>
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Daftar Pesanan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @if ($data->isEmpty())
                        <tbody>
                            <tr>
                                <td colspan="10" class="p-5 italic text-center">Daftar Order Kosong</td>
                            </tr>
                        </tbody>
                    @else
                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>
                                        @foreach ($d['details'] as $f)
                                            <p>{{ $f['name'] }} ({{ $f['quantity'] }})</p>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="buttons">
                                            <a href="{{ route('order.form.edit', ['id' => $d['id']]) }}">
                                                <button type="button" class="btn btn-warning btn-sm">Edit</button>
                                            </a>

                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#delete-modal-{{ $d['id'] }}"
                                                class="btn btn-danger btn-sm">Delete</button>
                                            <div class="modal fade" id="delete-modal-{{ $d['id'] }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Delete
                                                                Confirmation</h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>
                                                                Apa anda yakin ingin menghapus dari daftar order?
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>
                                                            <form
                                                                action={{ route('order.delete', ['id' => $d['id']]) }}
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
