@extends('layouts.main')

@section('title', 'ห้องทดลอง')
@section('subtitle', 'ห้องทดลอง')

@section('content')
    <div class="page-header">
        <h1 class="page-title">
            @yield('title')
        </h1>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="page-header">
                <h2 class="page-title">
                    {{ $lab->title }}
                </h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="">
                <div class="card-body">
                    <a href="{{ route('lab.exitLab', $lab->id) }}" class="btn btn-danger btn-block"><i class="fa fa-sign-out"></i>ออกจากการทดลอง</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h5"><strong>Instances (เครื่อง)</strong><br><small>จำกัด {{ $quota->instances['limit'] }} เครื่อง</small></div>
                    <div class="display-4 font-weight-bold mb-4">{{ $quota->instances['in_use'] }}</div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-green" style="width: {{ $quota->instances['in_use']/$quota->instances['limit'] * 100 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h5"><strong>vCPUs (Core)</strong><br><small>จำกัด {{ $quota->cores['limit'] }} Cores</small></div>
                    <div class="display-4 font-weight-bold mb-4">{{ $quota->cores['in_use'] }}</div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-green" style="width: {{ $quota->cores['in_use']/$quota->cores['limit'] * 100 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h5"><strong>Memory (MB)</strong><br><small>จำกัด {{ $quota->ram['limit'] }} MB</small></div>
                    <div class="display-4 font-weight-bold mb-4">{{ $quota->ram['in_use'] }} MB</div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-green" style="width: {{ $quota->ram['in_use']/$quota->ram['limit'] * 100 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h5"> <strong>Disk Space (GB)</strong><br>
                        <small>จำกัด {{ $storageQuota->gigabytes }} GB</small></div>
                    <div class="display-4 font-weight-bold mb-4">0 GB</div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-green" style="width: 0%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-code-fork"></i>Network Topology</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#createInstanceModal"><i class="fa fa-hdd-o"></i>สร้าง Instance</button>
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#createSubnetModal"><i class="fa fa-plus"></i>สร้าง Subnet</button>
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#createRouterModal"><i class="fa fa-plus"></i>สร้าง Router</button>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <form action="{{ route('admin.lab.openConsole', $lab->id) }}" target="_blank">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <select class="form-control" name="server_id">
                                                <option value="" disabled selected>เลือก VM</option>
                                                @foreach($servers as $server)
                                                    <option value="{{ $server->id }}">{{ $server->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-block btn-primary">Open Console</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="flatTopologyCanvasContainer">
                                <div class="nodata">There are no networks, routers, or connected instances to display.</div>
                                <svg width="400" height="400" id="topology_canvas">
                                    <defs>
                                        <pattern id="device_normal_bg" patternUnits="userSpaceOnUse" x="0" y="0" width="20" height="20">
                                            <g>
                                                <rect width="20" height="20" class="base_bg_normal"></rect>
                                            </g>
                                        </pattern>
                                        <pattern id="device_normal_bg_loading" patternUnits="userSpaceOnUse" x="0" y="0" width="20" height="20">
                                            <g>
                                                <rect width="20" height="20" class="loading_bg_normal"></rect>
                                                <path d='M0 20L20 0ZM22 18L18 22ZM-2 2L2 -2Z' stroke-linecap="square" stroke='rgba(0, 0, 0, 0.3)' stroke-width="7"></path>
                                            </g>
                                            <animate attributeName="x" attributeType="XML" begin="0s" dur="0.5s" from="0" to="-20" repeatCount="indefinite"></animate>
                                        </pattern>
                                        <pattern id="device_small_bg" patternUnits="userSpaceOnUse" x="0" y="0" width="20" height="20">
                                            <g>
                                                <rect width="20" height="20" class="base_bg_small"></rect>
                                            </g>
                                        </pattern>
                                        <pattern id="device_small_bg_loading" patternUnits="userSpaceOnUse" x="0" y="0" width="5" height="5">
                                            <g>
                                                <rect width="5" height="5" class="loading_bg_small"></rect>
                                                <path d='M0 5L5 0ZM6 4L4 6ZM-1 1L1 -1Z' stroke-linecap="square" stroke='rgba(0, 0, 0, 0.4)' stroke-width="1.5"></path>
                                            </g>
                                            <animate attributeName="x" attributeType="XML" begin="0s" dur="0.5s" from="0" to="-5" repeatCount="indefinite"></animate>
                                        </pattern>
                                    </defs>
                                </svg>
                                <svg id="topology_template" display="none">
                                    <g class="router_small device_body">
                                        <g class="ports" pointer-events="none"></g>
                                        <rect rx="3" ry="3" width="20" height="20" class="frame"></rect>
                                        <g transform="translate(3.5,3)" class="icon">
                                            <polygon points="12.51,4.23 12.51,0.49 8.77,0.49 9.68,1.4 6.92,4.16 8.84,6.08 11.6,3.32  "></polygon>
                                            <polygon points="0.49,8.77 0.49,12.51 4.23,12.51 3.32,11.6 6.08,8.83 4.17,6.92 1.4,9.68  "></polygon>
                                            <polygon points="1.85,5.59 5.59,5.59 5.59,1.85 4.68,2.76 1.92,0 0,1.92 2.76,4.68   "></polygon>
                                            <polygon points="11.15,7.41 7.41,7.41 7.41,11.15 8.32,10.24 11.08,13 13,11.08 10.24,8.32   "></polygon>
                                        </g>
                                    </g>
                                    <g class="instance_small device_body">
                                        <g class="ports" pointer-events="none"></g>
                                        <rect rx="3" ry="3" width="20" height="20" class="frame"></rect>
                                        <g transform="translate(5,3)" class="icon">
                                            <rect class="instance_bg" width="10" height="13"></rect>
                                            <rect x="2" y="1" fill="#FFFFFF" width="6" height="2"></rect>
                                            <rect x="2" y="4" fill="#FFFFFF" width="6" height="2"></rect>
                                            <circle class="active" cx="3" cy="10" r="1.3"></circle>
                                        </g>
                                    </g>
                                    <g class="network_container_small">
                                        <rect rx="7" ry="7" width="15" height="200" style="fill: #8541B5;" class="network-rect"></rect>
                                        <text x="250" y="-3" class="network-name" transform="rotate(90 0 0)" pointer-events="none">Network</text>
                                        <text x="0" y="-20" class="network-cidr" transform="rotate(90 0 0)">0.0.0.0</text>
                                        <text x="0" y="-20" class="network-type" transform="rotate(90 0 0)"
                                              data-toggle="tooltip" data-placement="bottom" title="External Network"></text>
                                    </g>
                                    <g class="router_normal device_body">
                                        <g class="ports" pointer-events="none"></g>
                                        <rect class="frame" x="0" y="0" rx="6" ry="6" width="90" height="50"></rect>
                                        <g class="texts" pointer-events="none">
                                            <rect class="texts_bg" x="1.5" y="32" width="87" height="17"></rect>
                                            <text x="45" y="46" class="type">Router</text>
                                            <text x="45" y="22" class="name">router</text>
                                        </g>
                                        <g class="icon" transform="translate(6,6)" pointer-events="none">
                                            <circle class="icon_bg" cx="0" cy="0" r="12"></circle>
                                            <g transform="translate(-6.5,-6.5)">
                                                <polygon points="12.51,4.23 12.51,0.49 8.77,0.49 9.68,1.4 6.92,4.16 8.84,6.08 11.6,3.32  "></polygon>
                                                <polygon points="0.49,8.77 0.49,12.51 4.23,12.51 3.32,11.6 6.08,8.83 4.17,6.92 1.4,9.68  "></polygon>
                                                <polygon points="1.85,5.59 5.59,5.59 5.59,1.85 4.68,2.76 1.92,0 0,1.92 2.76,4.68   "></polygon>
                                                <polygon points="11.15,7.41 7.41,7.41 7.41,11.15 8.32,10.24 11.08,13 13,11.08 10.24,8.32  "></polygon>
                                            </g>
                                        </g>
                                    </g>
                                    <g class="instance_normal device_body">
                                        <g class="ports" pointer-events="none"></g>
                                        <rect class="frame" x="0" y="0" rx="6" ry="6" width="90" height="50"></rect>
                                        <g class="texts">
                                            <rect class="texts_bg" x="1.5" y="32" width="87" height="17"></rect>
                                            <text x="45" y="46" class="type">VM</text>
                                            <text x="45" y="22" class="name">instance</text>
                                        </g>
                                        <g class="icon" transform="translate(6,6)">
                                            <circle class="icon_bg" cx="0" cy="0" r="12"></circle>
                                            <g transform="translate(-5,-6.5)">
                                                <rect class="instance_bg" width="10" height="13"></rect>
                                                <rect x="2" y="1" fill="#FFFFFF" width="6" height="2"></rect>
                                                <rect x="2" y="4" fill="#FFFFFF" width="6" height="2"></rect>
                                                <circle class="active" cx="3" cy="10" r="1.3"></circle>
                                            </g>
                                        </g>
                                    </g>
                                    <g class="network_container_normal">
                                        <rect rx="9" ry="9" width="17" height="500" style="fill: #8541B5;" class="network-rect"></rect>
                                        <text x="250" y="-4" class="network-name" transform="rotate(90 0 0)" pointer-events="none">Network</text>
                                        <text x="490" y="-20" class="network-cidr" transform="rotate(90 0 0)">0.0.0.0</text>
                                        <text x="490" y="-20" class="network-type" transform="rotate(90 0 0)"
                                              data-toggle="tooltip" data-placement="bottom" title="External Network"></text>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <h5>Instance List</h5>
                    <div class="table-responsive">
                        <table class="table card-table table-striped table-vcenter">
                            <thead>
                            <tr>
                                <th width="20px">ลำดับ</th>
                                <th>ชื่อ Instance</th>
                                <th width="60px">สถานะ</th>
                                <th width="550px">การกระทำ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($servers as $server)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $server->name }}</td>
                                    <td>{{ $server->vmState }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('stopInstance', [$lab->id, $project->id, $server->id]) }}" class="btn btn-pill btn-danger btn-sm"><i class="fa fa-stop"></i>หยุด</a>
                                        <a href="{{ route('startInstance', [$lab->id, $project->id, $server->id]) }}" class="btn btn-pill btn-success btn-sm"><i class="fa fa-play"></i>เริ่ม</a>
                                        <a href="{{ route('rebootInstance', [$lab->id, $project->id, $server->id]) }}" class="btn btn-pill btn-primary btn-sm"><i class="fa fa-refresh"></i>รีบูต</a>
                                        <a href="{{ route('terminateInstance', [$lab->id, $project->id, $server->id]) }}" class="btn btn-pill btn-warning btn-sm" onclick="return confirm('คุณต้องการจะลบ Instance นี้หรือไม่? ')"><i class="fa fa-trash"></i>ลบ Instance</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">ไม่มี Instance</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title"><i class="fa fa-map-signs"></i>ขั้นตอนการทดลอง</div>
                </div>
                <div class="card-body">
                    {!! $lab->instruction !!}
                </div>
            </div>
        </div>
    </div>

    @include('lab.createInstance')
    @include('lab.createSubnet')
    @include('lab.createRouter')
@endsection

@section('script')
    <script>
        $('.sidebar-toggle').click()
    </script>

    <script>
        var graph = {!! json_encode($graph) !!}
    </script>

    <script type="text/plain" id="balloon_container">
  <div class="topologyBalloon" id="@{{balloon_id}}">
    <a href="#close" class="closeTopologyBalloon">&times;</a>
    <div class="contentBody">
      @{{> table1}}
        @{{> table2}}
        </div>
        <div class="footer">
          <div class="footerInner">
            <div class="cell link">
              <a href="@{{url}}">» @{{view_details_label}}</a>


          @{{#console_id}}
        <a href="@{{url}}@{{console}}" class="vnc_window">» @{{open_console_label}}</a>
          @{{/console_id}}

        </div>
        </div>
      </div>
    </div>
</script>
    <script type="text/plain" id="balloon_device">
  <table class="detailInfoTable">
    <caption>@{{name}}</caption>
    <tbody>
    <tr>
      <th class="device">@{{id_label}}</th>
      <td>@{{id}}</td>
    </tr>
    <tr>
      <th class="device">@{{status_label}}</th>
      <td>
        <span class="@{{status_class}}">@{{status}}</span>
      </td>
    </tr>
    </tbody>
  </table>
</script>
    <script type="text/plain" id="balloon_port">
  <div class="portTableHeader">
    <div class="title">@{{interfaces_label}}</div>
    <div class="action">
      <a class="add-interface btn btn-default btn-xs ajax-modal @{{type}}" href="@{{add_interface_url}}">
        <span class="fa fa-plus"></span>
        @{{add_interface_label}}
        </a>
      </div>
    </div>
    <table class="detailInfoTable">
      <caption></caption>
      <tbody>
@{{#port}}
        <tr>
          <th>
            <span title="@{{id}}">
          <a href="@{{url}}">@{{id}}</a>
        </span>
      </th>
      <td>@{{ip_address}}</td>
      <td>@{{device_owner}}</td>
      <td>
        <span class="@{{port_status_class}}">@{{port_status}}</span>
      </td>
      <td class="delete">
        @{{#is_interface}}
        <button class="delete-port btn btn-danger btn-xs"
                data-router-id="@{{router_id}}" data-network-id="@{{network_id}}"
                data-port-id="@{{id}}">@{{delete_interface_label}}</button>
        @{{/is_interface}}
        </td>
      </tr>
@{{/port}}
        </tbody>
      </table>
</script>

    <script src="http://cdn.bootcss.com/d3/3.1.7/d3.js"></script>
    <script src="http://cdn.bootcss.com/hogan.js/3.0.2/hogan.min.js"></script>
    <script src="{{ asset('assets/topology/graph.js') }}"></script>

@endsection