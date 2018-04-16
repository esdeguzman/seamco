@extends('member.layout.main')

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
                                            <small class="pull-right">Date Requested: {{ Carbon\Carbon::parse($loan->created_at)->toFormattedDateString() }}</small>
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
                                            <strong>{{ strtoupper($loan->member->full_name) }}</strong>
                                            <br>{{ $loan->member->present_address }}
                                            <br>Contact no: {{ $loan->member->mobile_number }}
                                            <br>Position: {{ strtoupper($loan->member->position) }}
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        <b>Payment Terms:</b> {{ $loan->payment_terms }} months
                                        <br>
                                        <b>Comaker:</b>
                                        @if(is_null($comaker->status))
                                        <span class="label label-warning">NOT YET ANSWERED</span>
                                        @elseif($comaker->status == 1)
                                        {{ strtoupper($comaker->full_name) }}
                                        @elseif($comaker->status == 0)
                                        <span class="label label-danger">DENIED</span>
                                        @endif
                                        <br>
                                        <b>Requested Amount</b> P {{ number_format($loan->total_amount, 2) }}
                                        <br>
                                        <b>Approved Amount:</b> {!! is_null($loan->creditEvaluation->approved_amount) ? '<span class="label label-warning">NOT YET APPROVED</span>' : 'P ' . number_format($loan->creditEvaluation->approved_amount, 2) !!}
                                        <br>
                                        <b>Interest:</b> {!! is_null($loan->promissoryNote) ? '<span class="label label-warning">NOT YET APPROVED</span>' : 'P ' . number_format($loan->creditEvaluation->interest, 2) !!}
                                        <br>
                                        <b>Payment Due:</b> {!! is_null($loan->creditEvaluation->estimated_date_release) ? '<span class="label label-warning">NOT YET APPROVED</span>' : Carbon\Carbon::parse($loan->creditEvaluation->estimated_date_release)->addMonths($loan->payment_terms)->toFormattedDateString() !!}
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
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(is_null($loan->promissoryNote))
                                                <tr>
                                                    <td colspan="5" align="center">No Promises Retrieved</td>
                                                </tr>
                                            @else
                                                @foreach($loan->promisorryNote->promises as $promise)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($promise->due_date)->toFormattedDateString() }}</td>
                                                    <td>P {{ number_format($promise->amount, 2) }}</td>
                                                    <td>{{ $promise->payment->receivedBy->first_name }}</td>
                                                    <td>
                                                        @if($promise->payment->status == 0)
                                                        <span class="label label-warning text-uppercase">not yet paid</span>
                                                        @elseif($promise->payment->status == 1)
                                                        <span class="label label-success text-uppercase">paid</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endif
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
                                                    <p>{{ $loan->company_contact_number }}</p>
                                                    <p class="title text-primary">Monthly Income:</p>
                                                    <p>P {{ number_format($loan->monthly_income, 2) }}</p>
                                                    <p class="title text-primary">Take Home Pay:</p>
                                                    <p>P {{ number_format($loan->take_home_pay, 2) }}</p>
                                                    <p class="title text-primary">SSS / GSIS:</p>
                                                    <p>{{ $loan->sss_gsis }}</p>
                                                    <p class="title text-primary">Residence Tel. No:</p>
                                                    <p>{{ $loan->residence_telephone_number }}</p>
                                                </div>
                                            </th>
                                            <td>
                                                <div class="project_detail">
                                                    <p class="title text-primary">Approved By</p>
                                                    <p>{!! is_null($loan->creditEvaluation->verified_by) ? '<span class="label label-warning">NOT YET APPROVED</span>' : $loan->creditEvaluation->verified_by !!}</p>
                                                    <p class="title text-primary">Recommended for Loan Extension By</p>
                                                    <p>{!! is_null($loan->creditEvaluation->recommended_for_loan_extension_by) ? '<span class="label label-warning">NOT YET APPROVED</span>' : $loan->creditEvaluation->recommended_for_loan_extension_by !!}</p>
                                                    <p class="title text-primary">Approved For Payment By</p>
                                                    <p>{!! is_null($loan->creditEvaluation->approved_for_payment_by) ? '<span class="label label-warning">NOT YET APPROVED</span>' : $loan->creditEvaluation->approved_for_payment_by !!}</p>
                                                </div>
                                            </td>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-xs-6">
                                        <p class="lead">Amount Due {!! is_null($loan->creditEvaluation->estimated_date_release) ? '<span class="label label-warning">NOT YET APPROVED</span>' : Carbon\Carbon::parse($loan->creditEvaluation->estimated_date_release)->addMonths($loan->payment_terms)->toFormattedDateString() !!}
                                            @if(is_null($loan->promissoryNote))
                                                <span class="label label-warning pull-right">NOT YET APPROVED</span>
                                            @elseif(is_null($loan->promissoryNote->settled))
                                                <span class="label label-danger pull-right">NOT YET PAID</span>
                                            @elseif($loan->promissoryNote->settled)
                                                <span class="label label-success pull-right">PAID</span>
                                            @endif
                                        </p>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <th style="width:50%">Subtotal:</th>
                                                    <td>{{ is_null($loan->promissory) ? 'No Promises Retrieved' : 'P ' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Interest</th>
                                                    <td>{!! is_null($loan->promissoryNote) ? '<span class="label label-warning">NOT YET APPROVED</span>' : 'P '  .number_format($loan->creditEvaluation->interest, 2) !!}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total:</th>
                                                    <td>{{ is_null($loan->promissory) ? 'No Promises Retrieved' : 'P ' }}</td>
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
                                        @if($loan->comaker->member_id == \Illuminate\Support\Facades\Auth::guard('member')->user()->id)
                                            <button class="btn btn-primary pull-right"><i class="fa fa-thumbs-up"></i> APPROVED COMAKER REQUEST</button>
                                            <button class="btn btn-danger pull-right"><i class="fa fa-thumbs-down"></i> DENY COMAKER REQUEST</button>
                                        @endif
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