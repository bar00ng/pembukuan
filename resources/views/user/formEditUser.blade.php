@extends('master.master')

@section('title')
    <h3>Edit Kasir</h3>
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb" class='breadcrumb-header text-right'>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.list') }}">Daftar Kasir</a></li>
            <li class="breadcrumb-item active"><a href="#">Edit Kasir</a></li>
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
                            <form class="form" method="POST" action={{ route('user.patch', ['id' => $user['id']]) }} method="POST">
                                @method('PATCH')
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Nama User/ Kasir</label>
                                            <input type="text" id=""
                                                class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}"
                                                placeholder="Nama User/ Kasir" name="name"
                                                value={{ $errors->first('name') ? old('name') : $user['name'] }}>
                                            @if ($errors->first('name'))
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    {{ $errors->first('name') }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email"
                                            class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}"
                                            placeholder="example@example.com" value={{ $errors->first('email') ? old('email') : $user['email'] }}>
                                        @if ($errors->first('email'))
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $errors->first('email') }}
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" id=""
                                            class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}"
                                            placeholder="Password" name="password" value={{ old('password') }}>
                                        @if ($errors->first('password'))
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $errors->first('password') }}
                                        @endif
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
