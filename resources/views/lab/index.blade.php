@extends('layouts.app')

@section('title', 'ห้องทดลอง')
@section('subtitle', 'รายการห้องทดลองทั้งหมด')

@section('content')
    <div class="row">
        @forelse($labs as $lab)
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-body">
                    <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: left; padding: 7px 10px; margin-top: 0;">
                        {{ $lab->title }}
                    </h4>
                    <div class="media">
                        <div class="media-body">
                            <div class="clearfix lab-card">
                                <p class="pull-right">
                                    <a href="{{ route('lab.show', $lab->id) }}" class="btn btn-success btn-sm ad-click-event">
                                        <i class="fa fa-sign-in" aria-hidden="true"></i>เข้าสู่ห้องทดลอง
                                    </a>
                                </p>
                                <h4 style="margin-top: 0">รายละเอียดของการทดลอง</h4>
                                <p>{!! $lab->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <div class="text-center">
                <h1 class="text-muted">ไม่มีการทดลอง</h1>
            </div>
        @endforelse
    </div>
@endsection