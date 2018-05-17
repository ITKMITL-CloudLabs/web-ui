@extends('layouts.main')

@section('title', 'จัดการอิมเมจ (Images)')
@section('subtitle', 'อัพโหลดและแก้ไขอิมเมจในระบบ')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="page-header">
        <h1 class="page-title">
            @yield('title')
        </h1>
    </div>
    <div class="row row-cards">
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="text-right text-green">
                        6%
                        <i class="fe fe-chevron-up"></i>
                    </div>
                    <div class="h1 m-0">43</div>
                    <div class="text-muted mb-4">New Tickets</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="text-right text-green">
                        6%
                        <i class="fe fe-chevron-up"></i>
                    </div>
                    <div class="h1 m-0">43</div>
                    <div class="text-muted mb-4">New Tickets</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="text-right text-green">
                        6%
                        <i class="fe fe-chevron-up"></i>
                    </div>
                    <div class="h1 m-0">43</div>
                    <div class="text-muted mb-4">New Tickets</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-lg-6">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="text-right text-green">
                        6%
                        <i class="fe fe-chevron-up"></i>
                    </div>
                    <div class="h1 m-0">43</div>
                    <div class="text-muted mb-4">New Tickets</div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">รายการอิมเมจทั้งหมด</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-tabl">
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
                                <td>{{ $image->createdAt->format('Y-m-d H:i:s') }}</td>
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
        </div>
    </div>
    {{--<div class="box box-success">--}}
        {{--<div class="box-header with-border">--}}
            {{--<h3 class="box-title">การกระทำ</h3>--}}
        {{--</div>--}}
        {{--<div class="box-body">--}}
            {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadNewImageModal">--}}
                {{--<i class="fa fa-plus-square"></i>อัพโหลดอิมเมจใหม่--}}
            {{--</button>--}}
        {{--</div>--}}
    {{--</div>--}}

    @include('admin.image.create')
@endsection