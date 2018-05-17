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
                    <h3 class="card-title">รายการการทดลองทั้งหมด</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>ชื่อการทดลอง</th>
                            <th style="width: 160px">ระดับความยาก</th>
                            <th style="width: 160px">สร้างโดย</th>
                            <th style="width: 160px">สร้างเมื่อ</th>
                        </tr>
                        </thead>
                        <?php $i = 1; ?>
                        <tbody>
                        @forelse($labs as $lab)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td><a href="{{ route('admin.lab.show', $lab->id) }}">{{ $lab->title }}</a></td>
                                <td><div class="raty" data-score="{{ $lab->difficulty }}" data-name="difficulty" data-readonly="true"></div></td>
                                <td>John Doe</td>
                                <td>{{ $lab->created_at }}</td>
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