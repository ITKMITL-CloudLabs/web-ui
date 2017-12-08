@extends('layouts.app')

@section('title', 'ห้องทดลอง')
@section('subtitle', 'ห้องทดลอง')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-map-signs"></i>ขั้นตอนการทดลอง</h3>
                </div>
                <div class="box-body" style="height: 500px">
                    {!! $lab->instruction !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-desktop"></i>ทรัพยากร</h3>
                </div>
                <div class="box-body" style="padding: 20px;">
                    <div class="row">
                        <div class="col-xs-6 col-md-3 text-center">
                            <div style="display:inline;width:90px;height:90px;"><input type="text" class="knob" value="{{ $quota->instances['in_use'] }}" data-max="{{ $quota->instances['limit'] }}" data-width="90" data-height="90" data-fgcolor="#3c8dbc" data-readonly="true" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font-style: normal; font-variant: normal; font-weight: bold; font-stretch: normal; font-size: 18px; line-height: normal; font-family: Arial; text-align: center; color: rgb(60, 141, 188); padding: 0px; -webkit-appearance: none;"></div>

                            <div class="knob-label">
                                <strong>Instances (เครื่อง)</strong><br>
                                <small>จำกัด {{ $quota->instances['limit'] }} เครื่อง</small>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-xs-6 col-md-3 text-center">
                            <div style="display:inline;width:90px;height:90px;"><input type="text" class="knob" value="{{ $quota->cores['in_use'] }}" data-max="{{ $quota->cores['limit'] }}" data-width="90" data-height="90" data-fgcolor="#f56954" data-readonly="true" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font-style: normal; font-variant: normal; font-weight: bold; font-stretch: normal; font-size: 18px; line-height: normal; font-family: Arial; text-align: center; color: rgb(245, 105, 84); padding: 0px; -webkit-appearance: none;"></div>

                            <div class="knob-label">
                                <strong>vCPUs (Core)</strong><br>
                                <small>จำกัด {{ $quota->cores['limit'] }} Cores</small>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-xs-6 col-md-3 text-center">
                            <div style="display:inline;width:90px;height:90px;"><input type="text" class="knob" value="{{ $quota->ram['in_use'] }}" data-max="{{ $quota->ram['limit'] }}" data-width="90" data-height="90" data-fgcolor="#00a65a" data-readonly="true" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font-style: normal; font-variant: normal; font-weight: bold; font-stretch: normal; font-size: 18px; line-height: normal; font-family: Arial; text-align: center; color: rgb(0, 166, 90); padding: 0px; -webkit-appearance: none;"></div>

                            <div class="knob-label">
                                <strong>Memory (MB)</strong><br>
                                <small>จำกัด {{ $quota->ram['limit'] }} MB</small>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-xs-6 col-md-3 text-center">
                            <div style="display:inline;width:90px;height:90px;"><input type="text" class="knob" value="0" data-max="{{ $storageQuota->gigabytes }}" data-width="90" data-height="90" data-fgcolor="#00c0ef" data-readonly="true" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font-style: normal; font-variant: normal; font-weight: bold; font-stretch: normal; font-size: 18px; line-height: normal; font-family: Arial; text-align: center; color: rgb(0, 192, 239); padding: 0px; -webkit-appearance: none;"></div>

                            <div class="knob-label">
                                <strong>Disk Space (GB)</strong><br>
                                <small>จำกัด {{ $storageQuota->gigabytes }} GB</small>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-code-fork"></i>Network Topology</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#createInstanceModal"><i class="fa fa-hdd-o"></i>สร้าง Instance</button>
                                <button type="button" class="btn btn-default"><i class="fa fa-plus"></i>สร้าง Router</button>
                                <button type="button" class="btn btn-default"><i class="fa fa-plus"></i>สร้าง Subnet</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php $i = 1; ?>
                            @foreach($servers as $server)
                                {{$i++}}. {{ $server->name }}
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.lab.createInstance')
@endsection

@section('script')
    <script src="{{ asset('assets/jquery-knob/js/jquery.knob.js') }}"></script>
    <script>
      $(function () {
        $(".knob").knob({
          draw: function () {

            // "tron" case
            if (this.$.data('skin') == 'tron') {

              var a = this.angle(this.cv)  // Angle
                , sa = this.startAngle          // Previous start angle
                , sat = this.startAngle         // Start angle
                , ea                            // Previous end angle
                , eat = sat + a                 // End angle
                , r = true;

              this.g.lineWidth = this.lineWidth;

              this.o.cursor
              && (sat = eat - 0.3)
              && (eat = eat + 0.3);

              if (this.o.displayPrevious) {
                ea = this.startAngle + this.angle(this.value);
                this.o.cursor
                && (sa = ea - 0.3)
                && (ea = ea + 0.3);
                this.g.beginPath();
                this.g.strokeStyle = this.previousColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                this.g.stroke();
              }

              this.g.beginPath();
              this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
              this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
              this.g.stroke();

              this.g.lineWidth = 2;
              this.g.beginPath();
              this.g.strokeStyle = this.o.fgColor;
              this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
              this.g.stroke();

              return false;
            }
          }
        });
      });
    </script>
@endsection