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
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({
              google_ad_client: "ca-pub-6429484135715885",
              enable_page_level_ads: true
         });
    </script>
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
                        <img src="{{ url('/storage') .'/'. \Illuminate\Support\Facades\Auth::guard('member')->user()->photo_url }}" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>
                        <h2>{{ \Illuminate\Support\Facades\Auth::guard('member')->user()->full_name }}</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>Navigation</h3>
                        <ul class="nav side-menu">
                            <li @yield('my-profile')><a href="{{ route('members.show') }}"><i class="fa fa-user"></i> My Profile </a></li>
                            @if(\Illuminate\Support\Facades\Auth::guard('member')->user()->application->approved)
                                <li @yield('apply-for-loan')><a href="{{ route('loans.create', \Illuminate\Support\Facades\Auth::guard('member')->user()->id) }}"><i class="fa fa-credit-card"></i> Apply for Loan </a></li>
                                <li @yield('loans')><a href="{{ route('loans.index') }}"><i class="fa fa-money"></i> My Loans </a></li>
                            @endif
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
                                <img src="{{ url('/storage') .'/'. \Illuminate\Support\Facades\Auth::guard('member')->user()->photo_url }}" alt=""> {{ \Illuminate\Support\Facades\Auth::guard('member')->user()->username }}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="javascript:;">Help</a></li>
                                <li>
                                    <a onclick="logout()"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    <form id="logout" action="{{ url('/member/logout') }}" method="post">{{ csrf_field() }}</form>
                                </li>
                            </ul>
                        </li>

                        <li role="presentation" class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-green">
                                    @if($comakerRequests->where('status', null)->count() + $approvedLoans->count() > 0)
                                    {{ $comakerRequests->where('status', null)->count() + $approvedLoans->count() }}
                                    @else
                                    0
                                    @endif
                                </span>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                @if($comakerRequests->where('status', '===', null)->count() > 0)
                                @foreach($comakerRequests->where('status', null)->get() as $comakerRequest)
                                    <li>
                                        <a href="{{ route('loans.show', $comakerRequest->loan_id) }}">
                                            <span class="image">
                                                <img src="{{ url('/storage') .'/'. $comakerRequest->requestedBy->photo_url }}" alt="Profile Image" /></span>
                                                        <span>
                                                <span>{{ $comakerRequest->requestedBy->full_name }}</span>
                                                <span class="time">{{ \Carbon\Carbon::parse($comakerRequest->created_at)->diffForHumans() }}</span>
                                            </span>
                                            <span class="message">
                                                Total Loan Amount : {{ $comakerRequest->loan->total_amount }}
                                                to be paid for {{ $comakerRequest->loan->payment_terms }} months
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                                @endif
                                    @if($approvedLoans->count() > 0)
                                        @foreach($approvedLoans as $approvedLoan)
                                            <li>
                                                <a>
                                                    <span class="image">
                                                        <img src="{{ url('/storage') .'/'. $approvedLoan->member->photo_url }}" alt="Profile Image" /></span>
                                                            <span>
                                                        <span>{{ $approvedLoan->member->full_name }}</span>
                                                        <span class="time">{{ \Carbon\Carbon::parse($approvedLoan->updated_at)->diffForHumans() }}</span>
                                                    </span>
                                                    <span class="message">
                                                        Your Loan Application has been approved! With approved amount of P {{ number_format($approvedLoan->creditEvaluation->approved_amount, 2) }} to be paid for {{ $approvedLoan->payment_terms }} months
                                                    </span>
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                {{--<li>--}}
                                    {{--<div class="text-center">--}}
                                        {{--<a>--}}
                                            {{--<strong>See All Alerts</strong>--}}
                                            {{--<i class="fa fa-angle-right"></i>--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                {{--</li>--}}
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