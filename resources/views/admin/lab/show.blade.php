@extends('layouts.app')

@section('title', 'จัดการการทดลอง')
@section('subtitle', 'สร้างและแก้ไขการทดลองในระบบ')

@section('content')
{{ $lab }}
<form action="{{ route('admin.lab.destroy', $lab->id) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('delete') }}
    <button class="btn btn-block btn-danger btn-flat">ลบ</button>
</form>

@endsection