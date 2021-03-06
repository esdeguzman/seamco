@extends('admin.layout.main')

@section('page-title') | Approved Loans @stop

@section('loans') class="active" @stop

@section('approved-loans') class="current-page" @stop

@section('page-content')
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <h2>Loans</h2>
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Member Name</th>
                                <th>Member Code</th>
                                <th>Mobile Number</th>
                                <th>Requested Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>


                            <tbody>
                            @if(! is_null($loans))
                                @foreach($loans as $loan)
                                <tr>
                                    <td>{{ $loan->member->full_name }}</td>
                                    <td>{{ $loan->member->code }}</td>
                                    <td>{{ $loan->member->mobile_number }}</td>
                                    <td>P {{ number_format($loan->total_amount, 2) }}</td>
                                    <td>
                                        @if(is_null($loan->status))
                                            <label class="label label-warning text-uppercase">pending</label>
                                        @elseif(! is_null($loan->promissoryNote) and $loan->promissoryNote->settled == 1)
                                            <label class="label label-success text-uppercase">fully paid</label>
                                        @elseif($loan->status == 1)
                                            <label class="label label-success text-uppercase">approved</label>
                                        @elseif($loan->status == 0)
                                            <label class="label label-danger text-uppercase">denied</label>
                                        @elseif($loan->status == -1)
                                            <label class="label label-warning text-uppercase">archived</label>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.loan-show', $loan->id) }}"><span class="fa fa-eye"></span> View</a>
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