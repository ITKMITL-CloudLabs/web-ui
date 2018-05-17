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
                    <h3 class="card-title">รายการเทมเพลต ทั้งหมด</h3>
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
        </div>
    </div>
    {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createFlavorModal">--}}
        {{--<i class="fa fa-plus-square"></i>สร้างเทมเพลตใหม่--}}
    {{--</button>--}}


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