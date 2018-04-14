@extends('admin.layout.main')

@section('page-title') | Dashboard @stop

@section('dashboard') class="active" @stop

@section('page-content')
    <div class="right_col" role="main">
        <div class="row top_tiles">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-users"></i></div>
                    <div class="count">{{ $members->count() }}</div>
                    <h3>Members</h3>
                    <p>Count of all registered members</p>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-file"></i></div>
                    <div class="count">{{ $applicants->count() }}</div>
                    <h3>Applicants</h3>
                    <p>Current number of member applications</p>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-info"></i></div>
                    <div class="count">{{ $loanApplications->count() }}</div>
                    <h3>Loan Applications</h3>
                    <p>Loan count waiting for approval</p>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-lock"></i></div>
                    <div class="count">{{ $admins->count() }}</div>
                    <h3>Administrators</h3>
                    <p>Total count of system administrators</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>New Applicants</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if($applicants->count() > 0)
                            @foreach($applicants as $applicant)
                            <article class="media event">
                                <a class="pull-left date">
                                    <p class="month">{{ \Carbon\Carbon::parse($applicant->created_at)->format('F') }}</p>
                                    <p class="day">{{ \Carbon\Carbon::parse($applicant->created_at)->day }}</p>
                                </a>
                                <div class="media-body">
                                    <a class="title" href="{{ route('admin.review-applicant', $applicant->id) }}">{{ $applicant->full_name }}</a>
                                    <p>Contact Number: {{ $applicant->mobile_number }}</p>
                                    <p>Position: {{ $applicant->position }}</p>
                                </div>
                            </article>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>New Loan Applications</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                    </div>
                </div>
            </div>

            {{--<div class="col-md-4">--}}
                {{--<div class="x_panel">--}}
                    {{--<div class="x_title">--}}
                        {{--<h2>Top Profiles <small>Sessions</small></h2>--}}
                        {{--<div class="clearfix"></div>--}}
                    {{--</div>--}}
                    {{--<div class="x_content">--}}
                       {{----}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
</div>
@stop