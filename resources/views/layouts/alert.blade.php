@if(Session::has('alert_success'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
        <i class="fa fa-check-circle" aria-hidden="true"></i> {!! Session::get('alert_success') !!}
    </div>
@endif
@if(Session::has('alert_info'))
    <div class="alert alert-info" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
        <i class="fa fa-info-circle" aria-hidden="true"></i> {!! Session::get('alert_info') !!}
    </div>
@endif
@if(Session::has('alert_warning'))
    <div class="alert alert-warning" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
        <i class="fa fa-exclamation-circle" aria-hidden="true"></i> {!! Session::get('alert_warning') !!}
    </div>
@endif
@if(Session::has('alert_danger'))
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
        <i class="fa fa-times-circle" aria-hidden="true"></i> {!! Session::get('alert_danger') !!}
    </div>
@endif
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
        <strong><i class="fa fa-exclamation-triangle"></i> กรุณาตรวจสอบการกรอกข้อมูลอีกครั้ง</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
