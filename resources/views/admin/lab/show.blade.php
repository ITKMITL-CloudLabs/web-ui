@extends('layouts.main')

@section('title', 'รายละเอียดการทดลอง')
@section('subtitle', 'ข้อมูลการทดลองที่เลือก')

@section('content')
    <div class="page-header">
        <h1 class="page-title">
            @yield('title')
        </h1>
    </div>
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <div class="h2 mb-1">{{ $lab->title }}</div>
                    <div class="text-muted mb-4">สร้างโดย {{ auth()->user()->name }}</div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        <div class="h2 mb-1">รายละเอียด</div>
                        <hr>
                        @if($lab->description)
                            {!! $lab->description !!}
                        @else
                            <p class="text-center text-muted">ไม่มีรายละเอียดย่อ</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        <div class="h2 mb-1">วัตถุประสงค์</div>
                        <hr>
                        @if($lab->objective)
                            {!! $lab->objective !!}
                        @else
                            <p class="text-center text-muted">ไม่มีวัตถุประสงค์</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        <div class="h2 mb-1">ขั้นตอนการทดลอง</div>
                        <hr>
                        @if($lab->instruction)
                            {!! $lab->instruction !!}
                        @else
                            <p class="text-center text-muted">ไม่มีขั้นตอนการทดลอง</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 ">
            <div class="card p-3">
                <form class="inline" action="{{ route('admin.lab.togglePublishStatus', $lab->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('post') }}
                    @if(!$lab->is_published)
                        <button class="btn btn-success btn-block mb-2">
                            <i class="fa fa-check-circle"></i>เผยแพร่
                        </button>
                    @else
                        <button class="btn btn-warning btn-block mb-2">
                            <i class="fa fa-times-circle"></i>เลิกเผยแพร่
                        </button>
                    @endif
                </form>
                <a href="{{ route('admin.lab.edit', $lab->id) }}" class="btn btn-primary btn-block mb-2">
                    <i class="fa fa-edit"></i>แก้ไข
                </a>
                <form class="inline" action="{{ route('admin.lab.destroy', $lab->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button id="deleteBtn" class="btn btn-danger btn-block">
                        <i class="fa fa-trash"></i>ลบ
                    </button>
                </form>
            </div>
            <div class="card p-3">
                @if($lab->is_predefined_lab == 1)
                    <a href="{{ route('admin.lab.prepare', $lab->id) }}" class="btn btn-primary btn-block">
                        <i class="fa fa-flask"></i> เตรียมการทดลอง
                    </a>
                @endif
                <a href="#" data-toggle="modal" data-target="#resourceAdjustModal" class="btn btn-primary btn-block">
                    <i class="fa fa-pie-chart"></i> กำหนด Resource
                </a>
            </div>
            <!-- Components -->
            <div class="card p-3">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="lab-detail-list-title">ความยาก</div>
                        <div class="raty" data-score="{{ $lab->difficulty }}" data-name="difficulty" data-readonly="true"></div>
                    </li>
                    <li class="list-group-item">
                        <div class="lab-detail-list-title">สร้างโดย</div>
                        {{ auth()->user()->name }}
                    </li>
                    <li class="list-group-item">
                        <div class="lab-detail-list-title">สร้างเมื่อ</div>
                        {{ $lab->created_at }}
                    </li>
                    <li class="list-group-item">
                        <div class="lab-detail-list-title">แก้ไขล่าสุด</div>
                        {{ $lab->updated_at }}
                    </li>
                </ul>
            </div>

            <div class="card p-3">
                <ul class="lab-material-file-list">
                    @forelse($lab->formatted_material_files as $file)
                        <li><a href="{{ $file['url'] }}">{{ $file['name'] }} ({{ number_format(($file['size'] / 1024) / 1024, 2) }} MB)</a></li>
                    @empty
                        <li class="empty text-muted">ไม่มีไฟล์ประกอบ</li>
                    @endforelse
                </ul>

                <hr>

                <form action="{{ route('admin.lab.uploadMaterial', $lab->id) }}" enctype="multipart/form-data" method="post" class="text-center">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="input" class="form-control" name="name" placeholder="ชื่อไฟล์ (สำหรับแสดงในรายการไฟล์)">
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control" name="file">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-upload"></i>อัพโหลด</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        {{--<div class="col-md-3">--}}
            {{--<div class="box actions-box">--}}
                {{--<div class="box-header with-border">--}}
                    {{--<h3 class="box-title"><i class="fa fa-gears"></i>การกระทำ</h3>--}}
                {{--</div>--}}
                {{--<div class="box-body text-center">--}}

                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="box actions-box">--}}
                {{--<div class="box-header with-border">--}}
                    {{--<h3 class="box-title"><i class="fa fa-gears"></i>การเตรียมการทดลอง</h3>--}}
                {{--</div>--}}

            {{--</div>--}}

            {{--<div class="box">--}}
                {{--<div class="box-header with-border">--}}
                    {{--<h3 class="box-title"><i class="fa fa-info-circle"></i>ข้อมูลทั่วไป</h3>--}}
                {{--</div>--}}
                {{--<div class="box-body no-padding">--}}

                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="box">--}}
                {{--<div class="box-header with-border">--}}
                    {{--<h3 class="box-title"><i class="fa fa-file"></i>ไฟล์ประกอบ</h3>--}}
                {{--</div>--}}
                {{--<div class="box-body">--}}
                    {{--<ul class="lab-material-file-list">--}}
                        {{--@forelse($lab->formatted_material_files as $file)--}}
                            {{--<li><a href="{{ $file['url'] }}">{{ $file['name'] }} ({{ number_format(($file['size'] / 1024) / 1024, 2) }} MB)</a></li>--}}
                        {{--@empty--}}
                            {{--<li class="empty text-center text-muted">ไม่มีไฟล์ประกอบ</li>--}}
                        {{--@endforelse--}}
                    {{--</ul>--}}

                    {{--<hr>--}}

                    {{--<form action="{{ route('admin.lab.uploadMaterial', $lab->id) }}" enctype="multipart/form-data" method="post" class="text-center">--}}
                        {{--{{ csrf_field() }}--}}
                        {{--<div class="form-group">--}}
                            {{--<input type="input" class="form-control" name="name" placeholder="ชื่อไฟล์ (สำหรับแสดงในรายการไฟล์)">--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<input type="file" class="form-control" name="file">--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-upload"></i>อัพโหลด</button>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>

    @include('admin.lab.create')
    @include('admin.lab.resourceAdjustModal')

@endsection

@section('script')
    <script>
        $('#deleteBtn').on('click',function(e){
            e.preventDefault();
            var form = $(this).parents('form');
            swal({
                title: "ยืนยันการลบ",
                text: "คุณต้องการที่จะลบการทดลองนี้ ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "ยืนยัน",
                cancelButtonText: 'ยกเลิก'
            }).then(function () {
                form.submit();
            })
        });
    </script>
@endsection