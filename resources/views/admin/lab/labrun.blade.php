@extends('layouts.main')

@section('title', 'การทดลองที่กำลังดำเนินอยู่')

@section('style')
@endsection

@section('content')
    <div class="page-header">
        <h1 class="page-title">
            @yield('title')
        </h1>
    </div>
    <div class="row row-cards">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="h1 m-1">{{ $labs->count() }}</div>
                    <div class="text-muted mb-4">การทดลองที่ดำเนินอยู่ทั้งหมด</div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">รายการการทดลองที่ดำเนินอยู่ทั้งหมด</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>ชื่อนักศึกษา</th>
                            <th>ชื่อการทดลอง</th>
                            <th style="width: 160px">ระดับความยาก</th>
                            <th style="width: 160px">ประเภทการทดลอง</th>
                            <th style="width: 160px">สร้างเมื่อ</th>
                            <th style="width: 60px">การกระทำ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($labs as $lab)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $lab->name }}</td>
                                <td><a href="{{ route('admin.lab.show', $lab->currentlab->id) }}">{{ $lab->currentlab->title }}</a></td>
                                <td><div class="raty" data-score="{{ $lab->currentlab->difficulty }}" data-name="difficulty" data-readonly="true"></div></td>
                                <td>
                                    @if($lab->currentlab->is_predefined_lab == 1)
                                        มีสภาพแวดล้อมเริ่มต้น
                                    @else
                                        อิสระ
                                    @endif
                                </td>
                                <td>{{ $lab->currentlab->created_at }}</td>
                                <td><a href="{{ route('admin.observeLab', [$lab->currentlab->id, $lab->current_project_id]) }}" class="btn btn-pill btn-success btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Observe</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center text-muted" colspan="7">ไม่มีการทดลองที่กำลังดำเนินอยู่</td>
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