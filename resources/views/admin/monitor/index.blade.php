@extends('layouts.main')

@section('title', 'Monitor')

@section('style')
@endsection

@section('content')
    <div class="page-header">
        <h1 class="page-title">
            @yield('title')
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-6 col-lg-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h5">Memory Free</div>
                    <div class="display-4 font-weight-bold mb-4">{{ number_format((($monitor->free_ram_mb - $monitor->memory_mb_used))/1000, 2) }} GB</div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-green" style="width: {{ (($monitor->free_ram_mb - $monitor->memory_mb_used) / $monitor->free_ram_mb) * 100 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h5">Storage Free</div>
                    <div class="display-4 font-weight-bold mb-4">{{ $monitor->free_disk_gb }} GB</div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-green" style="width: {{ $monitor->free_disk_gb / $monitor->local_gb * 100 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h5">VCPUs Free</div>
                    <div class="display-4 font-weight-bold mb-4">{{ $monitor->vcpus - $monitor->vcpus_used }}</div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-green" style="width: {{ (($monitor->vcpus - $monitor->vcpus_used) / $monitor->vcpus) * 100 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">การทดลองที่กำลังดำเนินอยู่</div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ชื่อการทดลอง</th>
                                <th width="30px">การกระทำ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($labs as $lab)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $lab->currentLab->title }}</td>
                                <td>เร็วๆ นี้</td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="2">ไม่มีการทดลองที่กำลังดำเนินการอยู่</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="h1 m-0">{{ $monitor->running_vms }}</div>
                    <div class="text-muted mb-4">Running VMs</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="h1 m-0">{{ $monitor->disk_available_least }}</div>
                    <div class="text-muted mb-4">Disk Least</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="h1 m-0">{{ $monitor->memory_mb_used }} MB</div>
                    <div class="text-muted mb-4">Memory Used</div>
                </div>
            </div>
        </div>
    </div>
@endsection