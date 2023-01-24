@extends('master.master-auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 col-sm-12 mx-auto">
            <div class="card pt-4">
                <div class="card-body">
                    <div class="text-center mb-5">
                        <img src="assets/images/favicon.svg" height="48" class='mb-4'>
                        <h3>Sign Up</h3>
                        <p>Please fill the form to register.</p>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="name-column">Name</label>
                                    <input type="text" id="first-name-column" class="form-control"  name="name">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="email-id-column">Email</label>
                                    <input type="email" id="email-id-column" class="form-control" name="email">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="password-column">Password</label>
                                    <input type="password" name="password" class="form-control" id="">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="password-column">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="">
                                </div>
                            </div>
                        </div>

                                <a href="{{ route('login') }}">Have an account? Login</a>
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