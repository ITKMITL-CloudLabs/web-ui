@extends('layouts.app')

@section('title', 'รายละเอียดการทดลอง')
@section('subtitle', 'ข้อมูลการทดลองที่เลือก')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-flask"></i>ชื่อการทดลอง</h3>
                </div>
                <div class="box-body">
                    <h3 class="admin-lab-title">{{ $lab->title }}</h3>
                </div>
                <div class="box-footer clearfix">
                    <div class="pull-right">
                        สร้างโดย {{ auth()->user()->name }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-file"></i>รายละเอียดย่อ</h3>
                        </div>
                        <div class="box-body">
                            @if($lab->description)
                                {!! $lab->description !!}
                            @else
                                <p class="text-center text-muted">ไม่มีรายละเอียดย่อ</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-crosshairs"></i>วัตถุประสงค์</h3>
                        </div>
                        <div class="box-body">
                            @if($lab->objective)
                                {!! $lab->objective !!}
                            @else
                                <p class="text-center text-muted">ไม่มีวัตถุประสงค์</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-map-signs"></i>ขั้นตอนการทดลอง</h3>
                        </div>
                        <div class="box-body">
                            @if($lab->instruction)
                                {!! $lab->instruction !!}
                            @else
                                <p class="text-center text-muted">ไม่มีขั้นตอนการทดลอง</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box actions-box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-sign-in"></i>เริ่มการทดลอง</h3>
                </div>
                <div class="box-body text-center">
                    <a href="{{ route('lab.room', $lab->id) }}" class="btn btn-app bg-green btn-flat">
                        <i class="fa fa-desktop" aria-hidden="true"></i>เข้าสู่การทดลอง
                    </a>
                </div>
            </div>
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-info-circle"></i>ข้อมูลทั่วไป</h3>
                </div>
                <div class="box-body no-padding">
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
            </div>
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-file"></i>ไฟล์ประกอบ</h3>
                </div>
                <div class="box-body">
                    <ul class="lab-material-file-list">
                        @forelse($lab->formatted_material_files as $file)
                            <li><a href="{{ $file['url'] }}">{{ $file['name'] }} ({{ number_format(($file['size'] / 1024) / 1024, 2) }} MB)</a></li>
                        @empty
                            <li class="empty text-center text-muted">ไม่มีไฟล์ประกอบ</li>
                        @endforelse
                    </ul>
                </div>
            </div>

        </div>
    </div>
@endsection