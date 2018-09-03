@extends('member.layout.main')

@section('page-title') | Member Profile @stop

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
                                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Loans</a>
                                        </li>
                                        {{--<li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Denied Loans</a>--}}
                                        {{--</li>--}}
                                    </ul>
                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                            <table id="datatable" class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Loan ID</th>
                                                    <th>Requested Amount</th>
                                                    <th>Date Received</th>
                                                    <th>Status</th>
                                                    <th>Loan Details</th>
                                                </tr>
                                                </thead>


                                                <tbody>
                                                @if($loans->count() > 0)
                                                    @foreach($loans as $loan)
                                                    <tr>
                                                        <td>{{ $loan->id }}</td>
                                                        <td>P {{ number_format($loan->total_amount, 2) }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($loan->created_by)->toFormattedDateString() }}</td>
                                                        <td>
                                                            @if(is_null($loan->status))
                                                                <span class="label label-warning text-uppercase">pending</span>
                                                            @elseif($loan->status == 0)
                                                                <span class="label label-danger text-uppercase">denied</span>
                                                            @elseif($loan->status == 1)
                                                                <span class="label label-success text-uppercase">approved</span>
                                                            @elseif($loan->status == -1)
                                                                <label class="label label-warning text-uppercase">archived</label>
                                                            @endif
                                                        </td>
                                                        <td><a href="{{ route('loans.show', $loan->id) }}"><span class="fa fa-edit"> View</span></a></td>
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
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class="green">{{ title_case($member->full_name) }}</h3>

                                        {{--<p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>--}}
                                        <br />

                                        <div class="project_detail">

                                            <p class="title">Code</p>
                                            <p>{{ $member->code }}</p>
                                            <p class="title">Total Share Payments</p>
                                            <p>P {{ number_format($totalSharePayments, 2) }}</p>
                                            <p class="title">Share Amount</p>
                                            <p>P {{ number_format($currentShare->value, 2) }}</p>
                                            <p class="title">Current Savings</p>
                                            <p>P {{ number_format($savings, 2) }}</p>
                                            <p class="title">Username</p>
                                            <p>{{ $member->username }}</p>
                                            <p class="title">Position</p>
                                            <p>{{ $member->position }}</p>
                                            <p class="title">Mobile Number</p>
                                            <p>{{ $member->mobile_number }}</p>
                                            <p class="title">Present Address</p>
                                            <p>{{ $member->present_address }}</p>
                                        </div>

                                        <br />
                                        <h5>Change Password</h5>
                                        <form class="form" action="{{ route('member.change-password', \Illuminate\Support\Facades\Auth::guard('member')->user()->id) }}" method="post">
                                            {{ csrf_field() }} {{ method_field('put') }}
                                            <input class="form-control" type="password" placeholder="Old password" name="old_password"><br/>
                                            <input class="form-control" type="password" placeholder="New password" name="password"><br/>
                                            <div class="input-group">
                                                <input type="password" class="form-control" placeholder="Confirm password" name="password_confirmation"/>
                                                <span class="input-group-btn">
                                                      <button type="submit" class="btn btn-primary">Submit</button>
                                                </span>
                                            </div>
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
@stop