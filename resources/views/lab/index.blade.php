@extends('layouts.main')

@section('title', 'ห้องทดลอง')
@section('subtitle', 'รายการห้องทดลองทั้งหมด')

@section('content')
    <div class="page-header">
        <h1 class="page-title">
            @yield('title')
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">การทดลองที่คุณกำลังทำอยู่</h3>
                </div>
                <div class="card-body">
                    @if(auth()->user()->current_lab_id)
                    <div class="row">
                        <div class="col-md-5 border-right">
                            <div class="form-group">
                                <label class="form-label">ชื่อการทดลอง</label>
                                <div class="form-control-plaintext">{{ $currentlab->title }}</div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row d-flex justify-content-center pt-5">
                                <div class="col-md-4">
                                    <a href="{{ route('lab.room', auth()->user()->current_lab_id) }}" class="btn btn-success btn-block mb-1"><i class="fa fa-sign-in"></i>เข้าสู่ห้องทดลอง</a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('lab.exitLab', auth()->user()->current_lab_id) }}" class="btn btn-danger btn-block"><i class="fa fa-sign-out"></i>ออกจากห้องทดลอง</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    @else
                    <div class="text-center text-muted">
                        ไม่มีการทดลองที่กำลังทำอยู่
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <table class="table card-table table-vcenter">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>หัวข้อ</th>
                        <th class="text-center" width="200px">ระดับความยาก</th>
                        <th class="text-center" width="170px">ประเภทการทดลอง</th>
                        <th class="text-center" width="200px">วันที่เผยแพร่</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($labs as $lab)
                        <tr>
                            <td>{{ $loop->iteration }}.</td>
                            <td>
                                <a href="{{ route('lab.show', $lab->id) }}">{{ $lab->title }} </a>
                            </td>
                            <td class="text-center d-none d-md-table-cell text-nowrap">
                                <div class="raty" data-score="{{ $lab->difficulty }}" data-name="difficulty" data-readonly="true"></div>
                            </td>
                            <td>
                                @if($lab->is_predefined_lab == 1)
                                    มีสภาพแวดล้อมเริ่มต้น
                                @else
                                    อิสระ
                                @endif
                            </td>
                            <td class="text-center d-none d-md-table-cell text-nowrap">
                                {{ $lab->created_at }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-muted" colspan="4">ไม่มีการทดลอง</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection