<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <title>@yield('title') | CloudLabs</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="{{ asset('assets/tabler/js/require.min.js') }}"></script>
    <script>
        requirejs.config({
            baseUrl: '.'
        });
    </script>

    <!-- Dashboard Core -->
    <link rel="stylesheet" href="{{ asset('assets/tabler/css/dashboard.css') }}">
    <script src="{{ asset('assets/tabler/js/dashboard.js') }}"></script>
    <!-- c3.js Charts Plugin -->
    <link href="{{ asset('assets/tabler/plugins/charts-c3/plugin.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/tabler/plugins/charts-c3/plugin.js') }}"></script>
    <!-- Input Mask Plugin -->
    <script src="{{ asset('assets/tabler/plugins/input-mask/plugin.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">

    <!-- Font awesome -->
    <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}">

    @yield('style')

    <link rel="stylesheet" href="{{ asset('assets/cloudlabs/css/app.css') }}">

</head>
<body class="">
<div class="page">
    <div class="page-main">
        <div class="header py-4">
            <div class="container">
                <div class="d-flex">
                    <a class="header-brand" href="/">
                        <img src="{{ asset('assets/tabler/images/logo/logo.png') }}" class="header-brand-img" alt="tabler logo">
                        CloudLabs
                    </a>
                    <div class="d-flex order-lg-2 ml-auto">
                        <div class="dropdown d-none d-md-flex">
                            <a class="nav-link icon" data-toggle="dropdown">
                                <i class="fe fe-bell"></i>
                                <span class="nav-unread"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a href="#" class="dropdown-item d-flex">
                                    <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/male/41.jpg)"></span>
                                    <div>
                                        <strong>Nathan</strong> pushed new commit: Fix page load performance issue.
                                        <div class="small text-muted">10 minutes ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item d-flex">
                                    <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/female/1.jpg)"></span>
                                    <div>
                                        <strong>Alice</strong> started new task: Tabler UI design.
                                        <div class="small text-muted">1 hour ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item d-flex">
                                    <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/female/18.jpg)"></span>
                                    <div>
                                        <strong>Rose</strong> deployed new version of NodeJS REST Api V3
                                        <div class="small text-muted">2 hours ago</div>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item text-center text-muted-dark">Mark all as read</a>
                            </div>
                        </div>
                        <div class="dropdown">
                            <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                                <span class="avatar" style="background-image: url(http://www.marketaccessbd.com/wp-content/uploads/2014/08/avatar-1.png)"></span>
                                <span class="ml-2 d-none d-lg-block">
                      <span class="text-default">{{ auth()->user()->name }}</span>
                      <small class="text-muted d-block mt-1"><i class="fa fa-circle text-success"></i> Online</small>
                    </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="#">
                                    <i class="dropdown-icon fe fe-user"></i> Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="dropdown-icon fe fe-settings"></i> Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <span class="float-right"><span class="badge badge-primary">6</span></span>
                                    <i class="dropdown-icon fe fe-mail"></i> Inbox
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="dropdown-icon fe fe-send"></i> Message
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">
                                    <i class="dropdown-icon fe fe-help-circle"></i> Need help?
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="dropdown-icon fe fe-log-out"></i> Sign out
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                        <span class="header-toggler-icon"></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 ml-auto">
                        <ul class="nav nav-tabs border-0 flex-column flex-lg-row justify-content-end">
                            <li class="nav-item">
                                <a href="javascript:void(0)" @if(request()->is('admin*')) class="nav-link active" @else class="nav-link" @endif data-toggle="dropdown"><i class="fe fe-file"></i> Admin Menu</a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a href="{{ route('admin.monitor.index') }}" class="dropdown-item ">Monitor</a>
                                    <a href="{{ route('admin.user.index') }}" class="dropdown-item ">จัดการผู้ใช้งาน</a>
                                    <a href="{{ route('admin.lab.index') }}" class="dropdown-item ">จัดการแล็ป</a>
                                    <a href="{{ route('admin.image.index') }}" class="dropdown-item ">จัดการ Image</a>
                                    <a href="{{ route('admin.flavor.index') }}" class="dropdown-item ">จัดการเทมเพลท VM</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg order-lg-first">
                        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" @if(request()->is('dashboard*')) class="nav-link active" @else class="nav-link" @endif ><i class="fe fe-home"></i> Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('lab.index') }}" @if(request()->is('lab*')) class="nav-link active" @else class="nav-link" @endif ><i class="fe fe-box"></i> ห้องทดลอง</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-3 my-md-5">
            <div class="container">
                @include('layouts.alert')
                @yield('content')
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-auto ml-lg-auto">

                </div>
                <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                    <strong>Copyright &copy; {{ date('Y') }} <a href="{{ config('app.url') }}">{{  config('app.name') }}</a>.</strong> All rights reserved.
                </div>
            </div>
        </div>
    </footer>
</div>

<script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/raty/jquery.raty-fa.js') }}"></script>
<script>
    $('.modal').on('shown.bs.modal', function() {
        $(this).find('[autofocus]').focus();
    });

    $('.raty').raty({
        score: function() {
            return $(this).attr('data-score');
        },
        scoreName: function() {
            return $(this).attr('data-name');
        },
        readOnly: function() {
            return $(this).attr('data-readonly') == 'true';
        }
    })
</script>

@yield('script')

</body>
</html>