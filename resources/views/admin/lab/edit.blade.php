@extends('layouts.app')

@section('title', 'รายละเอียดการทดลอง')
@section('subtitle', 'ข้อมูลการทดลองที่เลือก')

@section('content')
    <form class="inline" action="{{ route('admin.lab.update', $lab->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('patch') }}
    <div class="row">
        <div class="col-md-9">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-flask"></i>ชื่อการทดลอง</h3>
                </div>
                <div class="box-body">
                    <input class="form-control input-lg" name="title" type="text" value="{{ $lab->title }}">
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="box actions-box text-center">
                <div class="box-body">
                    <button type="submit" class="btn btn-block btn-success btn-flat"><i class="fa fa-save"></i>บันทึก</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-file"></i>รายละเอียดย่อ</h3>
                        </div>
                        <div class="box-body">
                            <textarea name="description" id="description" rows="10" cols="80">
                                {!! $lab->description !!}
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-crosshairs"></i>วัตถุประสงค์</h3>
                        </div>
                        <div class="box-body">
                            <textarea name="objective" id="objective" rows="10" cols="80">
                                {!! $lab->objective !!}
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-map-signs"></i>ขั้นตอนการทดลอง</h3>
                        </div>
                        <div class="box-body">
                            <textarea name="instruction" id="instruction" rows="10" cols="80">
                                {!! $lab->instruction !!}
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-info-circle"></i>ข้อมูลทั่วไป</h3>
                </div>
                <div class="box-body no-padding">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="lab-detail-list-title">ความยาก</div>
                            {{ $lab->difficulty }}
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

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-file"></i>ไฟล์ประกอบ</h3>
                </div>
                <div class="box-body">

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