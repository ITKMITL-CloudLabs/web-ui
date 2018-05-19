@extends('layouts.main')

@section('title', 'แก้ไขบัญชี')

@section('style')
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
                <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}
                    <div class="card-header">
                        <h3 class="card-title">ข้อมูลบัญชี</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">ประเภท</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="role" value="student" class="selectgroup-input" @if($user->role == 'student')checked=""@endif>
                                            <span class="selectgroup-button">นักศึกษา</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="role" value="ta" class="selectgroup-input" @if($user->role == 'ta')checked=""@endif>
                                            <span class="selectgroup-button">ผู้ช่วยสอน</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="role" value="instructor" class="selectgroup-input" @if($user->role == 'instructor')checked=""@endif>
                                            <span class="selectgroup-button">อาจารย์</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control @if($errors->has('username')) is-invalid @endif" placeholder="Username" value="{{ $username->name }}" disabled>
                                    @if($errors->has('username'))
                                        <div class="invalid-feedback">{{ $errors->first('username') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">รหัสผ่าน</label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control @if($errors->has('password')) is-invalid @endif">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-secondary">สุ่ม</button>
                                        </div>
                                        @if($errors->has('password'))
                                            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">ชื่อบัญชี</label>
                                    <input type="text" name="name" class="form-control @if($errors->has('name')) is-invalid @endif" placeholder="ชื่อ-สกุล / ชื่อที่ต้องการให้แสดงในระบบ" value="{{ $user->name }}">
                                    @if($errors->has('name'))
                                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">สถานะบัญชี</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="enabled" value="1" class="selectgroup-input" checked="">
                                            <span class="selectgroup-button">เปิดใช้งาน</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="enabled" value="0" class="selectgroup-input">
                                            <span class="selectgroup-button">ปิดใช้งาน</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="btn-list text-center">
                            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary" onclick="return confirm('ยืนยันการละทิ้งข้อมูลทั้งหมด?')">ยกเลิก</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('admin.lab.create')
@endsection