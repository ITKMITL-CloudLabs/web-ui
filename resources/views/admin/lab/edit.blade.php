@extends('layouts.main')

@section('title', 'รายละเอียดการทดลอง')
@section('subtitle', 'ข้อมูลการทดลองที่เลือก')

@section('content')
    <div class="page-header">
        <h1 class="page-title">
            @yield('title')
        </h1>
    </div>
    <form class="inline" action="{{ route('admin.lab.update', $lab->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <input class="form-control input-lg mb-2" name="title" type="text" value="{{ $lab->title }}">
                        <div class="text-muted mb-4">สร้างโดย {{ auth()->user()->name }}</div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="mb-2">
                            <div class="h2 mb-1">รายละเอียด</div>
                            <hr>
                            <textarea name="description" id="description" rows="10" cols="115">
                                {!! $lab->description !!}
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="mb-2">
                            <div class="h2 mb-1">วัตถุประสงค์</div>
                            <hr>
                            <textarea name="objective" id="objective" rows="10" cols="115">
                                {!! $lab->objective !!}
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="mb-2">
                            <div class="h2 mb-1">ขั้นตอนการทดลอง</div>
                            <hr>
                            <textarea name="instruction" id="instruction" rows="10" cols="115">
                                {!! $lab->instruction !!}
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <button type="submit" class="btn btn-success btn-block">บันทึก</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card p-3">
                    <button type="submit" class="btn btn-success btn-block">บันทึก</button>
                </div>
                <div class="card p-3">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="lab-detail-list-title">ความยาก</div>
                            <div class="raty" data-score="{{ $lab->difficulty }}" data-name="difficulty" data-readonly="false"></div>
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
                    </ul>
                </div>
            </div>
        </div>


        </div>
    </div>
    </form>

    @include('admin.lab.create')
@endsection
@section('script')
    <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'description' );
        CKEDITOR.replace( 'objective' );
        CKEDITOR.replace( 'instruction' );
    </script>
@endsection