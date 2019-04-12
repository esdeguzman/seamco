@extends('admin.layout.main')

@section('page-title') | Applicant @stop

@section('page-content')
    <div class="right_col" role="main">
        <div class="">

            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Control Panel</h2>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                            <div class="col-md-9 col-sm-9 col-xs-12">

                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Approval Processes</a>
                                        </li>
                                    </ul>
                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                            <form class="form-horizontal form-label-left" action="{{ route('applications.update', $applicant->id) }}" method="post">
                                                {{ csrf_field() }} {{ method_field('put') }}

                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                    @if($applicant->application->approved == 1)
                                                        <h4 class="text text-uppercase">member has been approved by : 
                                                            @if($applicant->application->approvedBy)
                                                                {{ $applicant->application->approvedBy->first_name }}
                                                            @endif
                                                        </h4>
                                                    @elseif($applicant->application->approved === 0)
                                                        <input class="btn btn-block btn-danger" value="DENIED BY: {{ $applicant->application->disapprovedBy->first_name .' '. $applicant->application->disapprovedBy->last_name }}" disabled>
                                                    @else
                                                        <input class="btn btn-block btn-primary" value="APPROVE APPLICATION" name="action" type="submit" {{ is_null($applicant->application->approved) ? '' : 'disabled' }} >
                                                    @endif
                                                    <br>
                                                    @if(! is_null($applicant->application->attended_pmes))
                                                        <h4 class="text text-uppercase">attendance verified by : {{ $applicant->application->attendanceVerifiedBy->first_name }}</h4>
                                                    @else
                                                        <input class="btn btn-block btn-primary" value="MARK AS PMES ATTENDEE" name="action" type="submit" {{ $applicant->application->approved ? '' : 'disabled' }}>
                                                    @endif
                                                    <br>
                                                    @if(! is_null($applicant->application->fees_informed))
                                                        <h4 class="text text-uppercase">informed about fees by : {{ $applicant->application->feesInformedBy->first_name }}</h4>
                                                    @else
                                                        <input class="btn btn-block btn-primary" value="APPLICANT INFORMED ABOUT FEES" name="action" type="submit" {{ count($applicant->shares) == 0 ? 'disabled' : '' }}>
                                                    @endif
                                                    <br>
                                                    @if(! is_null($applicant->application->id_has_been_released))
                                                        <h4 class="text text-uppercase">id issued by : {{ $applicant->application->idReleasedBy->first_name }}</h4>
                                                    @else
                                                        <input class="btn btn-block btn-primary" value="ID HAS BEEN RELEASED" name="action" type="submit" {{ count($applicant->shares) == 0 ? 'disabled' : '' }}/>
                                                    @endif
                                                    <br>
                                                    @if(! is_null($applicant->application->share_cert_given))
                                                        <h4 class="text text-uppercase">share certificate released by : {{ $applicant->application->shareCertReleasedBy->first_name }}</h4>
                                                    @else
                                                        <input class="btn btn-block btn-primary" value="SHARE CERTIFICATE GIVEN" name="action" type="submit" {{ count($applicant->shares) == 0 ? 'disabled' : '' }}/>
                                                    @endif
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                    <h4 class="text-danger">Referred By:</h1>
                                                    <h5>{{ $member->referred_by or 'NONE' }}</h1>
                                                    <hr>
                                                    @if(is_null($applicant->application->approved))
                                                        <textarea name="disapproval_reason" class="form-control" rows="2" {{ $applicant->application->approved ? 'disabled' : '' }} placeholder="Disapproval reason is required for the denial of an applicant"></textarea><br/>
                                                        <button class="btn btn-block btn-danger">DISAPPROVE APPLICATION</button>
                                                    @elseif($applicant->application->approved == 1)
                                                        <h1>Application has already been approved!</h1>
                                                    @else
                                                        <h1 class="text-danger">Application has already been disapproved because of the following reason/s:</h1>
                                                        <h1>{{ $applicant->application->disapproval_reason }}</h1>
                                                    @endif
                                                </div>

                                                @if($applicant->application->attended_pmes && count($applicant->shares) == 0)
                                                <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-2 form-group">
                                                    <input type="text" name="max_share" class="form-control money" /><br/>
                                                    <button class="btn btn-block btn-success">SET MEMBER MAX SHARE</button>
                                                </div>
                                                @endif

                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- start project-detail sidebar -->
                            <div class="col-md-3 col-sm-3 col-xs-12">

                                <section class="panel">

                                    <div class="x_title">
                                        <h2>Applicant Information</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class="green">{{ $applicant->full_name }}</h3>

                                        {{--<p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>--}}
                                        <br />

                                        <div class="project_detail">

                                            <p class="title">Salary</p>
                                            <p>{{ $applicant->salary }}</p>
                                            <p class="title">Other Source Of Income</p>
                                            <p>{{ $applicant->other_source_of_income }}</p>
                                            <p class="title">Number Of Dependents</p>
                                            <p>{{ $applicant->number_of_dependents }}</p>
                                            <p class="title">Civil Status</p>
                                            <p>{{ $applicant->civil_status }}</p>
                                            <p class="title">Birth Date</p>
                                            <p>{{ $applicant->birth_date }}</p>
                                            <p class="title">Mobile Number</p>
                                            <p>{{ $applicant->mobile_number }}</p>
                                            <p class="title">Email Address</p>
                                            <p>{{ $applicant->email or 'NONE' }}</p>
                                            <p class="title">Gender</p>
                                            <p>{{ $applicant->gender }}</p>
                                            <p class="title">Present Address</p>
                                            <p>{{ $applicant->present_address }}</p>
                                            <p class="title">Permanent Address</p>
                                            <p>{{ $applicant->permanent_address }}</p>
                                            <p class="title">Position</p>
                                            <p>{{ $applicant->position }}</p>
                                            <p class="title">Department</p>
                                            <p>{{ $applicant->department }}</p>
                                            <p class="title">Employer</p>
                                            <p>{{ $applicant->employer }}</p>
                                            <p class="title">TIN</p>
                                            <p>{{ $applicant->tax_identification_number }}</p>
                                            <p class="title">Employment Date</p>
                                            <p>{{ $applicant->employment_date }}</p>
                                            <p class="title">Employer Address</p>
                                            <p>{{ $applicant->employer_address }}</p>
                                        </div>
                                    </div>

                                </section>

                            </div>
                            <!-- end project-detail sidebar -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{ url('js/jquery.mask.js') }}"></script>

    <script>
        $('.money').mask('#,##0.00', {reverse: true})
    </script>
@stop