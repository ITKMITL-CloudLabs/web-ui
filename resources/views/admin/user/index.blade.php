@extends('layouts.main')

@section('title', 'จัดการบัญชีผู้ใช้')

@section('style')
@endsection

@section('content')
    <div class="page-header">
        <h1 class="page-title">
            @yield('title')
        </h1>
    </div>
    <div class="row row-cards">
        <div class="col-3">
            <div class="card">
                <div class="card-body p-4 text-center">
                    <div class="h1 m-0">{{ \App\Models\User::onlyStudent()->count() }}</div>
                    <div class="text-muted">นักเรียน</div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body p-4 text-center">
                    <div class="h1 m-0">{{ \App\Models\User::onlyTA()->count() }}</div>
                    <div class="text-muted">ผู้ช่วยสอน</div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body p-4 text-center">
                    <div class="h1 m-0">{{ \App\Models\User::onlyInstructor()->count() }}</div>
                    <div class="text-muted">อาจารย์</div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body p-4 text-center">
                    <div class="h1 m-0">{{ $users->count() }}</div>
                    <div class="text-muted">รวมทั้งหมด</div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">จัดการบัญชีผู้ใช้</h3>
                    <div class="card-options">
                        <div class="form-inline">
                            <div class="mr-2">แสดง</div>
                            <div class="btn-group mr-3" role="group">
                                <a href="{{ route('admin.user.index') }}" class="btn btn-sm @if(request()->get('only', 'all') == 'all') btn-primary active @else btn-secondary @endif">ทั้งหมด</a>
                                <a href="{{ route('admin.user.index', ['only' => 'student']) }}" class="btn btn-sm @if(request()->get('only') == 'student') btn-primary active @else btn-secondary @endif">นักเรียน</a>
                                <a href="{{ route('admin.user.index', ['only' => 'ta']) }}" class="btn btn-sm @if(request()->get('only') == 'ta') btn-primary active @else btn-secondary @endif">ผู้ช่วย</a>
                                <a href="{{ route('admin.user.index', ['only' => 'instructor']) }}" class="btn btn-sm @if(request()->get('only') == 'instructor') btn-primary active @else btn-secondary @endif">อาจารย์</a>
                            </div>

                            <a href="{{ route('admin.user.create') }}" class="btn btn-sm btn-success dropdown-toggle"><i class="fe fe-plus-circle mr-2"></i>สร้างบัญชี</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-outline table-vcenter text-nowrap card-table">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>ชื่อ</th>
                            <th style="width: 120px;">Username</th>
                            <th style="width: 150px" class="text-center">กำลังทำการทดลอง</th>
                            <th style="width: 90px" class="text-center">ประเภท</th>
                            <th style="width: 165px">สร้างเมื่อ</th>
                            <th style="width: 165px" class="text-center">การกระทำ</th>
                        </tr>
                        </thead>
                        <?php $i = 1; ?>
                        <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->description }}</td>
                                <td>{{ $user->name }}</td>
                                <td class="text-center">
                                    <i class="fe @if($user->current_lab_id) fe-check-circle text-success @else fe-circle text-muted @endif"></i>
                                </td>
                                <td class="text-center">{{ $user->role_text }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td class="text-center">
                                    <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
                                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-sm btn-secondary">แก้ไข</a>

                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-sm btn-secondary" onclick="return confirm('ยืนยันการลบบัญชีนี้?')">ลบ</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center text-muted" colspan="7">ไม่มีบัญชีผู้ใช้</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

    @include('admin.lab.create')
@endsection