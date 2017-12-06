@extends('layouts.app')

@section('title', 'รายละเอียดการทดลอง')
@section('subtitle', 'ข้อมูลการทดลองที่เลือก')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-flask"></i>ชื่อการทดลอง</h3>
                </div>
                <div class="box-body">
                    <h3 class="admin-lab-title">{{ $lab->title }}</h3>
                </div>
                <div class="box-footer clearfix">
                    <div class="pull-right">
                        สร้างโดย {{ auth()->user()->name }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="box actions-box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-gears"></i>การจัดการของผู้ดูแลระบบ</h3>
                </div>
                <div class="box-body text-center">
                    @if($lab->predefined_lab == 1)
                    <a href="{{ route('admin.lab.prepare', $lab->id) }}" class="btn btn-app">
                        <i class="fa fa-flask"></i> เตรียมแล็บ
                    </a>
                    @endif
                    <a href="{{ route('admin.lab.edit', $lab->id) }}" class="btn btn-app">
                        <i class="fa fa-edit"></i> แก้ไข
                    </a>
                    <form class="inline" action="{{ route('admin.lab.destroy', $lab->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button id="deleteBtn" class="btn btn-app">
                            <i class="fa fa-trash"></i> ลบ
                        </button>
                    </form>

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
                            @if($lab->description)
                            {!! $lab->description !!}
                            @else
                                <p class="text-center text-muted">ไม่มีรายละเอียดย่อ</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-crosshairs"></i>วัตถุประสงค์</h3>
                        </div>
                        <div class="box-body">
                            @if($lab->objective)
                                {!! $lab->objective !!}
                            @else
                                <p class="text-center text-muted">ไม่มีวัตถุประสงค์</p>
                            @endif
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
                            @if($lab->instruction)
                                {!! $lab->instruction !!}
                            @else
                                <p class="text-center text-muted">ไม่มีขั้นตอนการทดลอง</p>
                            @endif
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
                            <div class="raty" data-score="{{ $lab->difficulty }}" data-name="difficulty" data-readonly="true"></div>
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
                    <p class="text-center text-muted">ไม่มีไฟล์ประกอบ</p>
                </div>
            </div>
        </div>
    </div>

    @include('admin.lab.create')
@endsection
@section('script')
    <script>
        $('#deleteBtn').on('click',function(e){
            e.preventDefault();
            var form = $(this).parents('form');
            swal({
                title: "ยืนยันการลบ",
                text: "คุณต้องการที่จะลบการทดลองนี้ ?",
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