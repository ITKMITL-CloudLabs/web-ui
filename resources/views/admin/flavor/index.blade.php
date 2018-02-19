@extends('layouts.app')

@section('title', 'จัดการเทมเพลต VM')
@section('subtitle', 'จัดการรายการเทมเพลต VM สำหรับประกอบการสร้าง Instance')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">การกระทำ</h3>
        </div>
        <div class="box-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createFlavorModal">
                <i class="fa fa-plus-square"></i>สร้างเทมเพลตใหม่
            </button>
        </div>
    </div>

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">รายการเทมเพลต ทั้งหมด</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-hover datatable">
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
                                    <button id="deleteFlavorBtn" class="btn btn-xs btn-danger">
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

    @include('admin.flavor.create')
@endsection

@section('script')
    <script>
        $('#deleteFlavorBtn').on('click',function(e){
            e.preventDefault();
            var form = $(this).parents('form');
            swal({
                title: "ยืนยันการลบ",
                text: "คุณต้องการที่จะลบเทมเพลตนี้ ?",
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