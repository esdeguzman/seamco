@extends('admin.layout.main')

@section('page-title') | Admins @stop

@section('admins') class="active" @stop

@section('admins') class="current-page" @stop

@section('page-content')
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <h2>Admins</h2>
                    <p class="text-muted font-13 m-b-30">
                        The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.
                    </p>
                    <table id="admins-table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Mobile Number</th>
                            <th>Present Address</th>
                            <th>Position</th>
                            <th>Actions</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($admins as $admin)
                        <tr>
                            <td>{{ $admin->first_name .' '. $admin->last_name }}</td>
                            <td>{{ $admin->code }}</td>
                            <td>{{ $admin->contact_number }}</td>
                            <td>{{ $admin->address }}</td>
                            <td>{{ $admin->position }}</td>
                            <td>
                                <a href="{{ route('admin.show', $admin->id) }}"><span class="fa fa-eye"></span> View</a>
                            </td>   
                        </tr>
                        @endforeach
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
<script>
    $(function(){
        $('#admins-table').dataTable({
            bSort: false
        })
    })
</script>
@stop