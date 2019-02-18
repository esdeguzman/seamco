@extends('admin.layout.main')

@section('page-title') | Member Details @stop

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
                                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Edit Member Info</a>
                                        </li>
                                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Share Payments</a>
                                        </li>
                                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Loan Payments</a>
                                        </li>
                                    </ul>
                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                            <form class="form-horizontal form-label-left" action="{{ route('admins.update-member-info', $member->id) }}" method="post">
                                                {{ csrf_field() }} {{ method_field('put') }}
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <input type="text" class="form-control has-feedback-left" placeholder="First Name" name="full_name" value="{{ $member->full_name }}" />
                                                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                    <input type="text" class="form-control" placeholder="Civil Status" name="civil_status" value="{{ $member->civil_status }}" />
                                                    <span class="fa fa-male form-control-feedback right" aria-hidden="true"></span>
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                    <input type="text" class="form-control has-feedback-left" placeholder="User Name" name="username" value="{{ $member->username }}" disabled/>
                                                    <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                    <input type="text" class="form-control" placeholder="Code" name="code" value="{{ $member->code }}" disabled/>
                                                    <span class="fa fa-barcode form-control-feedback right" aria-hidden="true"></span>
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                    <input type="text" class="form-control has-feedback-left" placeholder="Birth Date" name="birth_date" value="{{ $member->birth_date }}" />
                                                    <span class="fa fa-birthday-cake form-control-feedback left" aria-hidden="true"></span>
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                    <input type="text" class="form-control" placeholder="Mobile Number" name="mobile_number" value="{{ $member->mobile_number }}" />
                                                    <span class="fa fa-mobile-phone form-control-feedback right" aria-hidden="true"></span>
                                                </div>

                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <textarea class="form-control" name="present_address" rows="2" style="resize: none" placeholder="Present Address">{{ $member->present_address }}</textarea>
                                                </div>

                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <textarea class="form-control" name="permanent_address" rows="2" style="resize: none" placeholder="Permanent Address">{{ $member->permanent_address }}</textarea>
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                    <input type="text" class="form-control has-feedback-left" placeholder="Employer" name="employer" value="{{ $member->employer }}" />
                                                    <span class="fa fa-briefcase form-control-feedback left" aria-hidden="true"></span>
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                    <input type="text" class="form-control" placeholder="Tax Identification Number" name="tax_identification_number" value="{{ $member->tax_identification_number }}" />
                                                    <span class="fa fa-university form-control-feedback right" aria-hidden="true"></span>
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                    <input type="text" class="form-control has-feedback-left" placeholder="Position" name="position" value="{{ $member->position }}" />
                                                    <span class="fa fa-suitcase form-control-feedback left" aria-hidden="true"></span>
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                    <input type="text" class="form-control" placeholder="Department" name="department" value="{{ $member->department }}" />
                                                    <span class="fa fa-group form-control-feedback right" aria-hidden="true"></span>
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                    <input type="text" class="form-control has-feedback-left" placeholder="Employment Date" name="employment_date" value="{{ $member->employment_date }}" />
                                                    <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                    <input type="text" class="form-control" placeholder="Salary" name="salary" value="{{ number_format($member->salary, 2) }}" />
                                                    <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
                                                </div>

                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <textarea class="form-control" name="employer_address" rows="2" style="resize: none" placeholder="Employer Address">{{ $member->employer_address }}</textarea>
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                    <input type="text" class="form-control has-feedback-left" placeholder="Other Source of Income" name="other_source_of_income" value="{{ $member->other_source_of_income }}" />
                                                    <span class="fa fa-flash form-control-feedback left" aria-hidden="true"></span>
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                    <input type="text" class="form-control" placeholder="Number of Dependents" name="number_of_dependents" value="{{ $member->number_of_dependents }}" />
                                                    <span class="fa fa-sitemap form-control-feedback right" aria-hidden="true"></span>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                                        <button type="button" class="btn btn-primary">Cancel</button>
                                                        <button class="btn btn-primary" type="reset">Reset</button>
                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                                            @if($member->application->fees_informed)
                                            <form class="form-horizontal form-label-left" action="{{ route('admin.share-payment.store', $member->id) }}" method="post">
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount"></label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="text" id="amount" class="form-control col-md-7 col-xs-12 money" name="amount" placeholder="Enter member payment here" /> <br/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount"></label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <button class="btn btn-block btn-primary">RECEIVE MEMBER SHARE PAYMENT</button>
                                                    </div>
                                                </div>
                                                <div class="ln_solid"></div>
                                            </form>
                                            @endif

                                            <table id="datatable" class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Amount</th>
                                                    <th>Received By</th>
                                                    <th>Date Received</th>
                                                    <th>Share Balance</th>
                                                    <th>Savings</th>
                                                    <th>Remarks</th>
                                                </tr>
                                                </thead>


                                                <tbody>
                                                @if(! is_null($member->sharePayments))
                                                    @foreach($member->sharePayments as $payment)
                                                    <tr>
                                                        <td>{{ number_format($payment->amount, 2) }}</td>
                                                        <td>{{ $payment->receivedBy->first_name }}</td>
                                                        <td>{{ Carbon\Carbon::parse($payment->created_at)->toDayDateTimeString() }}</td>
                                                        <td>{{ number_format($payment->share_balance, 2) }}</td>
                                                        <td>{{ number_format($payment->savings, 2) }}</td>
                                                        <td>
                                                            @if($payment->remarks)
                                                                {{ $payment->remarks }}
                                                            @else
                                                                <a href="{{ route('share-payment.edit', $payment->id) }}"><span class="fa fa-comment"> Add Remarks</span></a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                                            @if($latestPromise)
                                                <form class="form-horizontal form-label-left" action="{{ route('loan-payments.store', [$currentLoan->id, $latestPromise->id]) }}" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount"></label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <label>Due Date : {{ \Carbon\Carbon::parse($latestPromise->due_date)->toFormattedDateString() }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount"></label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <label>Amount Due : P {{ number_format($latestPromise->amount, 2) }}</label>
                                                            <input class="money" type="text" name="amount_due" value="{{ $latestPromise->amount }}" hidden />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount"></label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input type="text" id="amount" class="form-control col-md-7 col-xs-12 money" name="paid_amount" placeholder="Enter member payment here" /> <br/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount"></label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <button class="btn btn-block btn-primary">RECEIVE MEMBER LOAN PAYMENT</button>
                                                        </div>
                                                    </div>
                                                    <div class="ln_solid"></div>
                                                </form>
                                            @endif

                                            <table id="datatable-fixed-header" class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Payment ID</th>
                                                    <th>Amount</th>
                                                    <th>Balance</th>
                                                    <th>Received By</th>
                                                    <th>Date Received</th>
                                                    <th>Remarks</th>
                                                    <th>Loan Details</th>
                                                </tr>
                                                </thead>


                                                <tbody>
                                                @if(! is_null($member->loanPayments))
                                                    @foreach($member->loanPayments as $payment)
                                                        <tr>
                                                            <td>{{ $payment->id }}</td>
                                                            <td>{{ number_format($payment->amount, 2) }}</td>
                                                            <td>{{ number_format($payment->loan_balance, 2) }}</td>
                                                            <td>{{ $payment->receivedBy->first_name }}</td>
                                                            <td>{{ Carbon\Carbon::parse($payment->created_at)->toFormattedDateString() }}</td>
                                                            <td><a href="#"><span class="fa fa-comment"> Add Remarks</span></a></td>
                                                            <td><a href="{{ route('admin.loan-show', $payment->loan_id) }}"><span class="fa fa-view"> View</span></a></td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- start project-detail sidebar -->
                            <div class="col-md-3 col-sm-3 col-xs-12">

                                <section class="panel">

                                    <div class="x_title">
                                        <h2>User Information</h2>
                                        <div class="clearfix">
                                            <img src="{{ url('/storage') .'/'. $member->photo_url }}" alt="..." class="img-circle profile_img">
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class="green">{{ $member->full_name }}</h3>

                                        {{--<p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>--}}
                                        <br />

                                        <div class="project_detail">

                                            <p class="title">Code</p>
                                            <p>{{ $member->code }}</p>
                                            <p class="title">Total Share Payments</p>
                                            <p>P {{ number_format($totalSharePayments, 2) }}</p>
                                            <p class="title">Share Amount</p>
                                            <p>P {{ number_format($member->shares->last()->value, 2) }}</p>
                                            <p class="title">Current Savings</p>
                                            <p>P {{ number_format($savings, 2) }}</p>
                                            <p class="title">Username</p>
                                            <p>{{ $member->username }}</p>
                                            <p class="title">Position</p>
                                            <p>{{ $member->position }}</p>
                                            <p class="title">Email</p>
                                            <p>{{ $member->email }}</p>
                                            <p class="title">Mobile Number</p>
                                            <p>{{ $member->mobile_number }}</p>
                                            <p class="title">Present Address</p>
                                            <p>{{ $member->present_address }}</p>
                                        </div>

                                        <br />
                                        <h5>Upload/Change Photo</h5>
                                        <form class="form" action="{{ route('members.update-photo', $member->id) }}" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }} {{ method_field('put') }}
                                            <div class="input-group">
                                                <input type="file" class="form-control" name="photo"/>
                                                <span class="input-group-btn">
                                                      <button type="submit" class="btn btn-primary">Submit</button>
                                                </span>
                                            </div>
                                        </form>

                                        <br />
                                        <h5>Update Share Value</h5>
                                        <form class="form" action="{{ route('share.store', $member->id) }}" method="post">
                                            {{ csrf_field() }} {{ method_field('put') }}
                                            <input class="form-control money" type="text" name="max_share" placeholder="Enter new Share Amount"><br/>
                                            <button type="submit" class="btn btn-block btn-success">UPDATE MEMBER'S SHARE VALUE</button>
                                        </form>
                                        <div class="ln_solid"></div>
                                        <h5>Reset Password</h5>
                                        <form class="form" action="#" method="post">
                                            {{ csrf_field() }} {{ method_field('put') }}
                                            <button type="submit" class="btn btn-block btn-danger">RESET MEMBER'S PASSWORD</button>
                                        </form>

                                        <br />
                                        <h5>Change Email</h5>
                                        <form class="form" action="#" method="post">
                                            {{ csrf_field() }} {{ method_field('put') }}
                                            <input class="form-control" type="email" name="email" placeholder="Enter new email address"><br/>
                                            <button type="submit" class="btn btn-block btn-primary">CHANGE USER EMAIL ADDRESS</button>
                                        </form>
                                        <br>
                                        <br>
                                        <br>
                                        <div class="ln_solid"></div>
                                        <h2 class="text text-uppercase text-danger center">danger zone</h2>
                                        <div class="ln_solid"></div>
                                        <form class="form" action="{{ route('admin.delete-member', $member->id) }}" method="post">
                                            {{ csrf_field() }} {{ method_field('delete') }}
                                            <button type="submit" class="btn btn-block btn-danger text-uppercase">delete member information</button>
                                        </form>
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
<!-- Datatables -->
<script src="{{ url('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ url('vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
<script src="{{ url('vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ url('vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ url('vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ url('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{ url('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ url('vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
<script src="{{ url('vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
<script src="{{ url('vendors/jszip/dist/jszip.min.js') }}"></script>
<script src="{{ url('vendors/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ url('vendors/pdfmake/build/vfs_fonts.js') }}"></script>

<script src="{{ url('js/jquery.mask.js') }}"></script>

<script>
    $('.money').mask('#,##0.00', {reverse: true})


</script>
@stop