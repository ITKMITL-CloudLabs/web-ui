@extends('layouts.main')

@section('title', 'ภาพรวม')
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
            <div class="row m-3">
                <div class="col-md-4">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi dolores eos labore pariatur quibusdam veritatis vero. Assumenda blanditiis cumque dolor exercitationem facere fugit libero modi natus praesentium, quidem. Cumque, similique.</p>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>
@endsection