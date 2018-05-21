@extends('layouts.main')

@section('title', 'จัดการเทมเพลต VM')
@section('subtitle', 'จัดการรายการเทมเพลต VM สำหรับประกอบการสร้าง Instance')

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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">รายการเทมเพลต ทั้งหมด</h3>
                    <div class="card-options">
                        <div class="form-inline">
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#createFlavorModal">
                                <i class="fa fa-plus-square"></i>สร้างเทมเพลตใหม่
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-tabl">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 10px">#</th>
                            <th width="200px">ชื่อ</th>
                            <th style="width: 160px">RAM</th>
                            <th style="width: 160px">SWAP</th>
                            <th style="width: 160px">Root Disk</th>
                            <th style="width: 160px">vCPUs</th>
                            <th style="width: 160px">ลบ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($flavors as $flavor)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $flavor->name }}</td>
                                <td>{{ $flavor->ram | 0}} MB</td>
                                <td>{{ $flavor->swap | "0" }} MB</td>
                                <td>{{ $flavor->disk | 0 }} GB</td>
                                <td>{{ $flavor->vcpus }}</td>
                                <td>
                                    <form class="inline" action="{{ route('admin.flavor.destroy', $flavor->id) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบเทมเพลต VM นี้?')">
                                            <i class="fa fa-trash"></i> ลบเทมเพลตนี้
                                        </button>
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


    @include('admin.flavor.create')
@endsection

@section('script')

@endsection