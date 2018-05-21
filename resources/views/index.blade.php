@extends('layouts.main')

@section('title', 'Cloud Computing System')
@section('subtitle', 'เทสๆ')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row d-flex justify-content-center">
                <div class="col-6 text-center">
                    <img class="img-fluid" width="30%" src="{{ asset('assets/tabler/images/logo/logo.png') }}">
                    <h1>CloudLabs</h1>
                    <p>Cloud Computing System V. 0.1<sup> Beta</sup></p>
                    <a class="btn btn-secondary" href="{{ route('lab.index')  }}">เข้าสู่ห้องทดลอง</a>
                </div>
            </div>
        </div>
    </div>
@endsection