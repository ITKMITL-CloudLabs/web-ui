@extends('layouts.app')

@section('title', 'จัดการอิมเมจ (Images)')
@section('subtitle', 'อัพโหลดและแก้ไขอิมเมจในระบบ')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">การกระทำ</h3>
        </div>
        <div class="box-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadImageModal">
                <i class="fa fa-plus-square"></i>อัพโหลดอิมเมจใหม่
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
                            <th class="text-center" style="width: 10px">#</th>
                            <th>ชื่อ</th>
                            <th style="width: 80px">ประเภท</th>
                            <th style="width: 80px">ขนาด</th>
                            <th style="width: 160px">สร้างเมื่อ</th>
                            <th style="width: 160px">ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($images as $image)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $image->name }}</td>
                            <td>{{ $image->diskFormat }}</td>
                            <td>{{ number_format(($image->size / 1024) / 1024, 2) }} MB</td>
                            <td>{{ \Carbon\Carbon::parse($image->createdAt->date)->setTimezone(0) }}</td>
                            <td>
                                <form action="{{ route('admin.image.destroy', $image->id) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button class="btn btn-xs btn-danger" onclick="return confirm('ยืนยันการลบอิมเมจนี้?')"><i class="fa fa-trash"></i> ลบอิมเมจ</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-muted" colspan="5">ไม่มีอิมเมจในระบบ</td>
                        </tr>
                    @endforelse
                    </tbody>
            </table>
        </div>
    </div>

    @include('admin.lab.create')
@endsection