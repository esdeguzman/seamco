<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Seamco @yield('page-title')</title>

    <!-- Bootstrap -->
    <link href="{{ url('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ url('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ url('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="{{ url('vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet"/>

    <!-- Custom Theme Style -->
    <link href="{{ url('build/css/custom.min.css') }}" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>SEAMCO</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="{{ url('/storage') .'/'. \Illuminate\Support\Facades\Auth::guard('admin')->user()->photo_url }}" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>
                        <h2>{{ \Illuminate\Support\Facades\Auth::guard('admin')->user()->first_name }}</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>Navigation</h3>
                        <ul class="nav side-menu">
                            <li @yield('dashboard')><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
                            <li @yield('my-profile')><a href="{{ route('admin.show', \Illuminate\Support\Facades\Auth::guard('admin')->user()->id) }}"><i class="fa fa-user"></i> My Profile </a></li>
                            {{--<li @yield('member-payments')><a><i class="fa fa-money"></i> Member Payments <span class="fa fa-chevron-down"></span></a>--}}
                                {{--<ul class="nav child_menu">--}}
                                    {{--<li @yield('shares-payment')><a>Shares</a></li>--}}
                                    {{--<li @yield('loans-payment')><a>Loans</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            <li @yield('members')><a><i class="fa fa-users"></i> Members <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li @yield('approved-members')><a href="{{ route('admin.approved-members') }}">Approved</a></li>
                                    <li @yield('denied-members')><a>Denied</a></li>
                                </ul>
                            </li>
                            <li @yield('loans')><a><i class="fa fa-users"></i> Loans <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li @yield('approved-members')><a href="{{ route('admin.loans-index') }}?status=1">Approved</a></li>
                                    <li @yield('approved-members')><a href="{{ route('admin.loans-index') }}?status=">Pending</a></li>
                                    <li @yield('approved-members')><a href="{{ route('admin.loans-index') }}?status=0">Denied</a></li>
                                    <li @yield('approved-members')><a href="{{ route('admin.loans-index') }}?status=-1">Archived</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                {{--<div class="sidebar-footer hidden-small">--}}
                    {{--<a data-toggle="tooltip" data-placement="top" title="Settings">--}}
                        {{--<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>--}}
                    {{--</a>--}}
                    {{--<a data-toggle="tooltip" data-placement="top" title="FullScreen">--}}
                        {{--<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>--}}
                    {{--</a>--}}
                    {{--<a data-toggle="tooltip" data-placement="top" title="Lock">--}}
                        {{--<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>--}}
                    {{--</a>--}}
                    {{--<a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">--}}
                        {{--<span class="glyphicon glyphicon-off" aria-hidden="true"></span>--}}
                    {{--</a>--}}
                {{--</div>--}}
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <img src="{{ url('/storage') .'/'. \Illuminate\Support\Facades\Auth::guard('admin')->user()->photo_url }}" alt="">{{ \Illuminate\Support\Facades\Auth::guard('admin')->user()->username }}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="javascript:;">Help</a></li>
                                <li>
                                    <a onclick="logout()"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    <form id="logout" action="{{ url('/admin/logout') }}" method="post">{{ csrf_field() }}</form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
        <!-- /top navigation -->

        <!-- page content -->
        @yield('page-content')
        <!-- /page content -->

        <div class="clearfix"></div>

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                SEAMCO Web Service 2018
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>

<!-- jQuery -->
<script src="{{ url('vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ url('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ url('vendors/fastclick/lib/fastclick.js') }}"></script>
<!-- NProgress -->
<script src="{{ url('vendors/nprogress/nprogress.js') }}"></script>
<!-- jQuery custom content scroller -->
<script src="{{ url('vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>

@yield('scripts')

<!-- Custom Theme Scripts -->
<script src="{{ url('build/js/custom.min.js') }}"></script>

<script>
    function logout() {
        $('#logout').submit()
    }

    @if(session('info'))
        alert('{{ session('info') }}')
    @endif
</script>
</body>
</html>