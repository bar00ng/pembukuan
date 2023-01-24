@extends('master.master-auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-sm-12 mx-auto">
            <div class="card pt-4">
                <div class="card-body">
                    <div class="text-center mb-5">
                        <img src="assets/images/favicon.svg" height="48" class='mb-4'>
                        <h3>Sign In</h3>
                        <p>Please sign in to continue.</p>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group position-relative has-icon-left">
                            <label for="email">email</label>
                            <div class="position-relative">
                                <input type="text" class="form-control" id="email" name="email">
                                <div class="form-control-icon">
                                    <i data-feather="email"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left">
                            <div class="clearfix">
                                <label for="password">Password</label>
                            </div>
                            <div class="position-relative">
                                <input type="password" class="form-control" id="password" name="password">
                                <div class="form-control-icon">
                                    <i data-feather="lock"></i>
                                </div>
                            </div>
                        </div>

                        <div class='form-check clearfix my-4'>
                            <div class="float-end">
                                <a href="{{ route('register') }}">Don't have an account?</a>
                            </div>
                        </div>
                        <div class="clearfix">
                            <button class="btn btn-primary float-end">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection