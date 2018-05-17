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
        <div class="card">
            <table class="table card-table table-vcenter">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>หัวข้อ</th>
                        <th class="text-center" width="200px">ระดับความยาก</th>
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
@endsection