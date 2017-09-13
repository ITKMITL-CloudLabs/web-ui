@extends('layouts.app')

@section('title', 'จัดการการทดลอง')
@section('subtitle', 'สร้างและแก้ไขการทดลองในระบบ')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">การกระทำ</h3>
        </div>
        <div class="box-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createLabModal">
                <i class="fa fa-plus-square"></i>สร้างการทดลองใหม่
            </button>
        </div>
    </div>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">รายการการทดลองทั้งหมด</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-hover datatable">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>ชื่อการทดลอง</th>
                            <th style="width: 160px">ระดับความยาก</th>
                            <th style="width: 160px">สร้างโดย</th>
                            <th style="width: 160px">สร้างเมื่อ</th>
                        </tr>
                    </thead>
                <?php $i = 1; ?>
                    <tbody>
                    @forelse($labs as $lab)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td><a href="{{ route('admin.lab.show', $lab->id) }}">{{ $lab->title }}</a></td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-danger" style="width: 80%"></div>
                                </div>
                            </td>
                            <td>John Doe</td>
                            <td>{{ $lab->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-muted" colspan="5">ไม่มีการทดลอง</td>
                        </tr>
                    @endforelse
                    </tbody>
            </table>
        </div>
    </div>

    @include('admin.lab.create')
@endsection