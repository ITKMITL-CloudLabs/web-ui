@extends('layouts.login')

@section('title', 'Sign In')

@section('content')
    <div class="page">
        <div class="page-single">
            <div class="container">
                <div class="row">
                    <div class="col col-login mx-auto">
                        <div class="text-center mb-6">
                            <img src="./assets/brand/tabler.svg" class="h-6" alt="">
                        </div>
                        <form class="card" action="{{ route('login') }}" method="post">
                            {{ csrf_field() }}
                            <div class="card-body p-6">
                                <div class="card-title">Login to your CloudLabs account</div>
                                <div class="form-group">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" placeholder="Enter Username">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        Password
                                        <a href="./forgot-password.html" class="float-right small">I forgot password</a>
                                    </label>
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" />
                                        <span class="custom-control-label">Remember me</span>
                                    </label>
                                </div>
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                                </div>
                            </div>
                        </form>
                        <div class="text-center text-muted">
                            <strong>Copyright &copy; {{ date('Y') }} <a href="{{ config('app.url') }}">{{  config('app.name') }}</a>.</strong>
                            <br>All rights reserved.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection