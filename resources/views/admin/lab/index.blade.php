@extends('layouts.app')

@section('title', 'จัดการการทดลอง')
@section('subtitle', 'สร้างและแก้ไขการทดลองในระบบ')

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Removable</h3>
        </div>
        <div class="box-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createLabModal">
                <i class="fa fa-plus-square"></i>สร้างการทดลองใหม่
            </button>
        </div>
    </div>

    @include('admin.lab.create')
@endsection