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
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>New Applicants</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Fullname</th>
                                <th>Contact Number</th>
                                <th>Position</th>
                                <th>Actions</th>
                            </tr>
                            </thead>


                            <tbody>
                            @if(! is_null($applicants))
                                @foreach($applicants as $applicant)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($applicant->created_at)->toFormattedDateString() }}</td>
                                    <td>{{ $applicant->full_name }}</td>
                                    <td>{{ $applicant->mobile_number }}</td>
                                    <td>{{ $applicant->position }}</td>
                                    <td>
                                        <a href="{{ route('admin.review-applicant', $applicant->id) }}"><span class="fa fa-eye"></span> View</a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>New Loan Applications</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                    <table id="datatable-loans" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Fullname</th>
                                <th>Contact Number</th>
                                <th>Position</th>
                                <th>Actions</th>
                            </tr>
                            </thead>


                            <tbody>
                            @if(! is_null($loanApplications))
                                @foreach($loanApplications as $loanApplication)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($loanApplication->created_at)->toFormattedDateString() }}</td>
                                    <td>{{ $loanApplication->member->full_name }}</td>
                                    <td>{{ $loanApplication->member->mobile_number }}</td>
                                    <td>{{ $loanApplication->member->position }}</td>
                                    <td>
                                        <a href="{{ route('admin.loan-show', $loanApplication->id) }}"><span class="fa fa-eye"></span> View</a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
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
    <script type="text/javascript">
        $('#datatable-loans').DataTable()
    </script>
@stop