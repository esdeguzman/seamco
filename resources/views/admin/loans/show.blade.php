@extends('admin.layout.main')

@section('page-title') | Loan Details @stop

@section('page-content')
    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_content">

                            <section class="content invoice">
                                <!-- title row -->
                                <div class="row">
                                    <div class="col-xs-12 invoice-header">
                                        <h1>
                                            <i class="fa fa-credit-card"></i> Loan Details
                                            <small class="pull-right">Date Requested: 16/08/2016</small>
                                        </h1>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        From
                                        <address>
                                            <strong>Seafarers Mighty Credit Cooperative</strong>
                                            <br>2nd Floor, Hotel de Mercedes,
                                            <br>Pelaez Street, Cebu City
                                            <br>Contact nos: 09282683776 / 413 2230
                                            <br>Email: info@seamco.org
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        To
                                        <address>
                                            <strong>John Doe</strong>
                                            <br>795 Freedom Ave, Suite 600
                                            <br>New York, CA 94107
                                            <br>Phone: 1 (804) 123-9876
                                            <br>Email: jon@ironadmin.com
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        <b>Payment Terms:</b> 12 months
                                        <br>
                                        <b>Comaker:</b> Mr. Estrella
                                        <br>
                                        <br>
                                        <b>Approved Amount:</b> P 500,000.00
                                        <br>
                                        <b>Interest:</b> P 20,000.00
                                        <br>
                                        <b>Payment Due:</b> 2/22/2014
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="row">
                                    <div class="col-xs-12 table">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Promised Date</th>
                                                <th>Amount</th>
                                                <th>Payment Accepted By</th>
                                                <th>Status</th>
                                                <th>Subtotal</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>March 31, 2018</td>
                                                <td>P 500,000.00</td>
                                                <td>Admin 1</td>
                                                <td><span class="label label-warning">Not yet paid</span></td>
                                                <td>P 500,000.00</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                    <!-- accepted payments column -->
                                    <div class="col-xs-6">
                                        {{--<p class="lead">Payment Methods:</p>--}}
                                        {{--<img src="images/visa.png" alt="Visa">--}}
                                        {{--<img src="images/mastercard.png" alt="Mastercard">--}}
                                        {{--<img src="images/american-express.png" alt="American Express">--}}
                                        {{--<img src="images/paypal.png" alt="Paypal">--}}
                                        {{--<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">--}}
                                            {{--Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.--}}
                                        {{--</p>--}}
                                        <table>
                                            <th style="width: 60%">
                                                <div class="project_detail">
                                                    <p class="title text-primary">Company Contact Number:</p>
                                                    <p>456-5684</p>
                                                    <p class="title text-primary">Monthly Income:</p>
                                                    <p>P 25,000.00</p>
                                                    <p class="title text-primary">Take Home Pay:</p>
                                                    <p>P 25,000.00</p>
                                                    <p class="title text-primary">SSS / GSIS:</p>
                                                    <p>123-456-789-101</p>
                                                    <p class="title text-primary">Residence Tel. No:</p>
                                                    <p>864-5231</p>
                                                </div>
                                            </th>
                                            <td>
                                                <div class="project_detail">
                                                    <p class="title text-primary">Approved By</p>
                                                    <p>Credit Commitee</p>
                                                    <p class="title text-primary">Recommended for Loan Extension By</p>
                                                    <p>General Manager</p>
                                                    <p class="title text-primary">Approved For Payment By</p>
                                                    <p>Chairman of the Board</p>
                                                </div>
                                            </td>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-xs-6">
                                        <p class="lead">Amount Due 2/22/2014
                                            <span class="label label-success pull-right">PAID</span>
                                        </p>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <th style="width:50%">Subtotal:</th>
                                                    <td>$250.30</td>
                                                </tr>
                                                <tr>
                                                    <th>Interest</th>
                                                    <td>$10.34</td>
                                                </tr>
                                                <tr>
                                                    <th>Total:</th>
                                                    <td>$265.24</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- this row will not appear when printing -->
                                <div class="row no-print">
                                    <div class="col-xs-12">
                                        <button class="btn btn-primary"><i class="fa fa-eye"></i> View Member's Profile</button>
                                        {{--<button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>--}}
                                        {{--<button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>--}}
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')

@stop