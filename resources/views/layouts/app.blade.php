<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') | CloudLabs</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/css/skin-blue.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/css/sweetalert2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,300italic,400italic,600italic">

    @yield('style')

    <link rel="stylesheet" href="{{ asset('assets/cloudlabs/css/app.css') }}">
</head>

<body class="hold-transition skin-blue fixed sidebar-mini">

<div class="wrapper">
<header class="main-header">
    <a href="../../index2.html" class="logo">
        <span class="logo-mini"><b>C</b>L</span>
        <span class="logo-lg"><b>Cloud</b>Labs</span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="http://www.marketaccessbd.com/wp-content/uploads/2014/08/avatar-1.png"
                             class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="http://www.marketaccessbd.com/wp-content/uploads/2014/08/avatar-1.png"
                                 class="img-circle" alt="User Image">

                            <p>
                                {{ auth()->user()->name }}
                                <small>Member since Nov. 2012</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">โปรไฟล์</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}" class="btn btn-default btn-flat">ออกจากระบบ</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="http://www.marketaccessbd.com/wp-content/uploads/2014/08/avatar-1.png" class="img-circle"
                     alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> ออนไลน์</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">เมนูหลัก</li>
            <li @if(request()->is('dashboard*')) class="active" @endif><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> <span>ภาพรวม</span></a></li>
            <li @if(request()->is('lab*')) class="active" @endif><a href="{{ route('lab.index') }}"><i class="fa fa-flask"></i> <span>ห้องแล็บ</span></a></li>

            <li class="header">เมนูผู้ดูแลระบบ</li>
            <li><a href="#"><i class="fa fa-dashboard"></i> <span>ภาพรวมของระบบ</span></a></li>
            <li @if(request()->is('admin/lab*')) class="active" @endif><a href="{{ route('admin.lab.index') }}"><i class="fa fa-flask"></i> <span>จัดการแล็บ</span></a></li>
            <li><a href="#"><i class="fa fa-users"></i> <span>จัดการผู้ใช้</span></a></li>
            <li @if(request()->is('admin/image*')) class="active" @endif><a href="{{ route('admin.image.index') }}"><i class="fa fa-hdd-o"></i> <span>จัดการอิมเมจ (Images)</span></a></li>
        </ul>
    </section>
</aside>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            @yield('title')
            <small>@yield('subtitle')</small>
        </h1>
        {{--<ol class="breadcrumb">--}}
            {{--<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>--}}
            {{--<li><a href="#">Layout</a></li>--}}
            {{--<li class="active">Fixed</li>--}}
        {{--</ol>--}}
    </section>

    <section class="content">
        @yield('content')
    </section>
</div>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 0.1
    </div>
    <strong>Copyright &copy; {{ date('Y') }} <a href="{{ config('app.url') }}">{{  config('app.name') }}</a>.</strong> All rights reserved.
</footer>

<script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('assets/fastclick/fastclick.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/raty/jquery.raty-fa.js') }}"></script>

<script src="{{ asset('assets/AdminLTE/js/adminlte.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/js/sweetalert2.min.js') }}"></script>
<script>
    $('.modal').on('shown.bs.modal', function() {
        $(this).find('[autofocus]').focus();
    });

    $('.datatable').dataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.16/i18n/Thai.json'
        }
    })

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

@yield('script')

</body>
</html>