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
                <a href="{{ route('lab.room', $lab->id) }}" class="btn btn-primary btn-block">
                    <i class="fa fa-sign-in"></i> เข้าสู่การทดลอง
                </a>
            </div>
            <!-- Components -->
            <div class="card p-3">
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

                <ul class="list-group"></ul>
            </div>

            <div class="card p-3">
                <ul class="lab-material-file-list">
                    @forelse($lab->formatted_material_files as $file)
                        <li><a href="{{ $file['url'] }}">{{ $file['name'] }} ({{ number_format(($file['size'] / 1024) / 1024, 2) }} MB)</a></li>
                    @empty
                        <li class="empty text-muted">ไม่มีไฟล์ประกอบ</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

@endsection