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
                                                <tr>
                                                    <td>1</td>
                                                    <td>P 1,000,000.00</td>
                                                    <td>Today</td>
                                                    <td>Pending</td>
                                                    <td><a href="#"><span class="fa fa-edit"> View</span></a></td>
                                                </tr>
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
                                        <h3 class="green">Esmeraldo B. de Guzman Jr</h3>

                                        {{--<p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>--}}
                                        <br />

                                        <div class="project_detail">

                                            <p class="title">Code</p>
                                            <p>P0024006</p>
                                            <p class="title">Current Savings</p>
                                            <p>P 0</p>
                                            <p class="title">Share Amount</p>
                                            <p>P 50,000.00</p>
                                            <p class="title">Username</p>
                                            <p>esme</p>
                                            <p class="title">Position</p>
                                            <p>Programmer</p>
                                            <p class="title">Email</p>
                                            <p>deguzman.esmeraldo@gmail.com</p>
                                            <p class="title">Contact Number</p>
                                            <p>09182815569</p>
                                            <p class="title">Address</p>
                                            <p>Venus neighborhood Sitio Libjo, Brgy. Sto. Niño Parañaque</p>
                                        </div>

                                        <br />
                                        <h5>Change Password</h5>
                                        <form class="form" action="#" method="post">
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