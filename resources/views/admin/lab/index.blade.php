@extends('layouts.main')

@section('title', 'จัดการการทดลอง')
@section('subtitle', 'สร้างและแก้ไขการทดลองในระบบ')

@section('style')
@endsection

@section('content')
    <div class="page-header">
        <h1 class="page-title">
            @yield('title')
        </h1>
    </div>
    <div class="row row-cards">
        <div class="col-6 col-sm-4 col-lg-4">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="h1 m-1">{{ $labs->count() }}</div>
                    <div class="text-muted mb-4">การทดลองทั้งหมด</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-4">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="h1 m-1">{{ $notdefinedlab->count() }}</div>
                    <div class="text-muted mb-4">อิสระ</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-4 col-lg-4">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="h1 m-1">{{ $predefinedlab->count() }}</div>
                    <div class="text-muted mb-4">มีสภาพแวดล้อมเริ่มต้น</div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">รายการการทดลองทั้งหมด</h3>
                    <div class="card-options">
                        <div class="form-inline">
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#createLabModal">
                                <i class="fe fe-plus-circle mr-2"></i>สร้างการทดลอง
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>ชื่อการทดลอง</th>
                            <th style="width: 160px">ระดับความยาก</th>
                            <th style="width: 160px">ประเภทการทดลอง</th>
                            <th style="width: 160px">สร้างเมื่อ</th>
                            <th style="width: 50px">เผยแพร่</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($labs as $lab)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{ route('admin.lab.show', $lab->id) }}">{{ $lab->title }}</a></td>
                                <td><div class="raty" data-score="{{ $lab->difficulty }}" data-name="difficulty" data-readonly="true"></div></td>
                                <td>
                                    @if($lab->is_predefined_lab == 1)
                                        มีสภาพแวดล้อมเริ่มต้น
                                    @else
                                        อิสระ
                                    @endif
                                </td>
                                <td>{{ $lab->created_at }}</td>
                                <td class="text-center">
                                    @if($lab->is_published == 1)
                                        <i class="fa fa-check" style="color: green"></i>
                                    @else
                                        <i class="fa fa-times" style="color: red"></i>
                                    @endif
                                </td>
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
        </div>
    </div>

    @include('admin.lab.create')
@endsection