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
                                        @if($loan->comaker->status === 0 && ! is_null($loan->comaker->status))
                                            <span class="label label-danger">COMAKER REQUEST HAS BEEN DENIED</span>
                                        @elseif($loan->comaker->status == 1)
                                            {{ strtoupper($loan->comaker->member->full_name) }}
                                        @elseif(is_null($loan->comaker->status))
                                            <span class="label label-warning">NOT YET ANSWERED</span>
                                        @endif
                                        <br>
                                        <b>Requested Amount</b> P {{ number_format($loan->total_amount, 2) }}
                                        <br>
                                        <b>Approved Amount:</b>
                                        @if($loan->status === 0)
                                            <span class="label label-danger text-uppercase">loan application has been denied</span>
                                        @elseif(is_null($loan->creditEvaluation) || is_null($loan->creditEvaluation->approved_amount))
                                            <span class="label label-warning">NOT YET ANSWERED</span>
                                        @else
                                            P {{ number_format($loan->creditEvaluation->approved_amount, 2) }}
                                        @endif
                                        <br>
                                        <b>Interest:</b>
                                        @if($loan->status === 0)
                                            <span class="label label-danger text-uppercase">loan application has been denied</span>
                                        @elseif(is_null($loan->creditEvaluation) || is_null($loan->creditEvaluation->interest))
                                            <span class="label label-warning">NOT YET ANSWERED</span>
                                        @else
                                            P {{ number_format($loan->creditEvaluation->interest, 2) }}
                                        @endif
                                        <br>
                                        <b>Payment Due:</b>
                                        @if($loan->status === 0)
                                            <span class="label label-danger text-uppercase">loan application has been denied</span>
                                        @elseif(is_null($loan->creditEvaluation) || is_null($loan->creditEvaluation->estimated_date_release))
                                            <span class="label label-warning">NOT YET ANSWERED</span>
                                        @else
                                            {{ Carbon\Carbon::parse($loan->creditEvaluation->estimated_date_release)->addMonths($loan->payment_terms)->toFormattedDateString() }}
                                        @endif
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
                                                @foreach($loan->promissoryNote->promises as $promise)
                                                    <tr>
                                                        <td>{{ \Carbon\Carbon::parse($promise->due_date)->toFormattedDateString() }}</td>
                                                        <td>P {{ number_format($promise->amount, 2) }}</td>
                                                        <td>
                                                            @if(is_null($promise->payment))
                                                                <span class="label label-warning text-uppercase">not yet paid</span>
                                                            @else
                                                                {{ $promise->payment->receivedBy->first_name }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($promise->status === 0)
                                                                <span class="label label-warning text-uppercase">not yet paid</span>
                                                            @elseif($promise->status == 1)
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
                                                    <p class="title text-primary">Date of Last Loan</p>
                                                    <p>
                                                        @if (count($loan->creditEvaluation) > 0)
                                                            {{ \Carbon\Carbon::parse($loan->creditEvaluation->date_of_last_loan)->toFormattedDateString() }}
                                                        @else
                                                            None
                                                        @endif
                                                    </p>
                                                    <p class="title text-primary">Balance of Last Loan</p>
                                                    <p>
                                                        @if (count($loan->creditEvaluation) > 0)
                                                            P {{ number_format($loan->creditEvaluation->balance_of_last_loan, 2) }}
                                                        @else
                                                            None
                                                        @endif
                                                    </p>
                                                    <p class="title text-primary">Recommended for Loan Extension By</p>
                                                    @if($loan->status === 0) <p><span class="label label-danger text-uppercase">loan application has been denied</span></p>
                                                    @elseif(\Illuminate\Support\Facades\Auth::guard('admin')->user()->username == 'gm_rico' && is_null($loan->creditEvaluation->recommended_for_loan_extension_by) && (! is_null($loan->comaker->status) && $loan->comaker->status)) {{-- (! is_null($loan->creditEvaluation)) --}}
                                                        <form action="{{ route('loans.update', $loan->id) }}" method="post">
                                                            {{ csrf_field() }} {{ method_field('put') }}
                                                            <input type="submit" value="APPROVE" name="gm_response" class="btn btn-primary form-control" />
                                                            <input type="submit" value="DISAPPROVE" name="gm_response" class="btn btn-danger form-control" />
                                                        </form>
                                                    @elseif(\Illuminate\Support\Facades\Auth::guard('admin')->user()->username == 'gm_rico' && (is_null($loan->creditEvaluation->approved_amount)) && $loan->creditEvaluation->status)
                                                        <br>
                                                        <form action="{{ route('loans.update', $loan->id) }}" method="post">
                                                            {{ csrf_field() }} {{ method_field('put') }}
                                                            <label for="approved_amount">Approved Amount</label>
                                                            <input type="text" name="approved_amount" class="form-control money" /><br>
                                                            <label for="interest">Interest</label>
                                                            <input type="text" name="interest" class="form-control money" /><br>
                                                            <label for="estimated_date_release">Estimated Date of Release</label>
                                                            <input type="text" name="estimated_date_release" class="form-control date" /><br>
                                                            <button type="submit" class="btn btn-primary text-uppercase btn-block">save approved amount</button>
                                                        </form>
                                                    @elseif(! is_null($loan->creditEvaluation->recommended_for_loan_extension_by))
                                                        <p><span class="label label-success">GENERAL MANAGER</span></p>
                                                    @else
                                                        <p><span class="label label-warning">NOT YET APPROVED</span></p>
                                                    @endif

                                                    <p class="title text-primary">Approved By</p>
                                                    @if($loan->status === 0)
                                                        <p><span class="label label-danger text-uppercase">loan application has been denied</span></p>
                                                    @elseif(\Illuminate\Support\Facades\Auth::guard('admin')->user()->username == 'cc_dex' && (! is_null($loan->creditEvaluation) && ! is_null($loan->creditEvaluation->recommended_for_loan_extension_by)) && ! is_null($loan->creditEvaluation->status) && is_null($loan->creditEvaluation->verified_by))
                                                        <form action="{{ route('loans.update', $loan->id) }}" method="post">
                                                            {{ csrf_field() }} {{ method_field('put') }}
                                                            <input type="submit" value="APPROVE" name="cc_response" class="btn btn-primary form-control" />
                                                            <input type="submit" value="DISAPPROVE" name="cc_response" class="btn btn-danger form-control" />
                                                        </form>
                                                    @elseif(! is_null($loan->creditEvaluation->verified_by))
                                                        <p><span class="label label-success">CREDIT COMMITTEE</span></p>
                                                    @else
                                                        <p><span class="label label-warning">NOT YET APPROVED BY CREDIT COMMITTEE</span></p>
                                                    @endif

                                                    <p class="title text-primary">Approved For Payment By</p>
                                                    @if($loan->status === 0) <p><span class="label label-danger text-uppercase">loan application has been denied</span></p>
                                                    @elseif(\Illuminate\Support\Facades\Auth::guard('admin')->user()->username == 'ch_lloyd' && (! is_null($loan->creditEvaluation) && ! is_null($loan->creditEvaluation->verified_by)) && is_null($loan->creditEvaluation->approved_for_payment_by))
                                                    <form action="{{ route('loans.update', $loan->id) }}" method="post">
                                                        {{ csrf_field() }} {{ method_field('put') }}
                                                        <input type="submit" value="APPROVE" name="ch_response" class="btn btn-primary form-control" />
                                                        <input type="submit" value="DISAPPROVE" name="ch_response" class="btn btn-danger form-control" />
                                                    </form>
                                                    @elseif(\Illuminate\Support\Facades\Auth::guard('admin')->user()->username != 'ch_lloyd' && ! is_null($loan->creditEvaluation->verified_by) && is_null($loan->creditEvaluation->approved_for_payment_by))
                                                        <p><span class="label label-primary">WAITING FOR CHAIRMAN OF THE BOARD'S RESPONSE</span></p>
                                                    @elseif(! is_null($loan->creditEvaluation->approved_for_payment_by))
                                                        <p><span class="label label-success">CHAIRMAN OF THE BOARD</span></p>
                                                    @else
                                                        <p><span class="label label-primary">WAITING FOR CHAIRMAN OF THE BOARD'S RESPONSE</span></p>
                                                    @endif
                                                </div>
                                            </td>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-xs-6">
                                        <p class="lead">Amount Due
                                            @if($loan->status === 0)
                                            @elseif(is_null($loan->creditEvaluation) || is_null($loan->creditEvaluation->estimated_date_release))
                                                <span class="label label-warning">NOT YET APPROVED</span>
                                            @else
                                                P {{ number_format($loan->creditEvaluation->approved_amount + $loan->creditEvaluation->interest,2) }}
                                            @endif

                                            @if($loan->status === -1)
                                                <span class="label label-warning pull-right">Archived</span>
                                            @elseif(! is_null($loan->remarks))
                                                <span class="label label-danger pull-right">Denied</span>
                                            @elseif(is_null($loan->promissoryNote) && $loan->status != 1)
                                                <span class="label label-warning pull-right">NOT YET APPROVED</span>
                                            @elseif((! is_null($loan->promissoryNote)) && is_null($loan->promissoryNote->settled))
                                                <span class="label label-danger pull-right">NOT YET PAID</span>
                                            @elseif((! is_null($loan->promissoryNote)) && $loan->promissoryNote->settled)
                                                <span class="label label-success pull-right">PAID</span>
                                            @endif
                                        </p>
                                        @if($loan->status === -1 or $loan->status === 0) <b class="text-primary">Note: {{ $loan->remarks }}</b> @endif
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- this row will not appear when printing -->
                                <div class="row no-print">
                                    <div class="col-xs-12">
{{--                                        @if($loan->comaker->member_id == \Illuminate\Support\Facades\Auth::guard('member')->user()->id && is_null($loan->comaker->status))--}}
                                        @if(! is_null($loan->status) and $loan->status != '-1')
                                            <form action="{{ route('loans.archive', $loan->id) }}?process=archive" method="post" class="pull-right">
                                                {{ csrf_field() }} {{ method_field('put') }}
                                                <button class="btn btn-warning pull-right text-uppercase" type="submit">Archive</button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.show-member', $loan->member->id) }}" method="get">
                                            <button class="btn btn-primary pull-right text-uppercase"type="submit">view member's information</button>
                                            {{--<input class="btn btn-danger pull-right col-md-3" value="DENY COMAKER REQUEST" name="response" type="submit"/>--}}
                                        </form>
                                        {{--@endif--}}
                                        {{--<button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>--}}
                                        {{--<button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>--}}
                                        <form action="{{ route('loans.delete', $loan->id) }}?process=delete&status={{ $loan->status }}" method="post">
                                            {{ csrf_field() }} {{ method_field('delete') }}
                                            <b class="text-danger col-md-8 pull-right" style="margin-bottom: 5px;">
                                                @if($errors->has('remarks')) {{ $errors->first('remarks') }}
                                                @else Warning! Deleting loan information will permanently remove its details from the system and cannot be undone.
                                                @endif
                                            </b>
                                            <textarea class="col-md-8 pull-right" style="margin-bottom: 5px; margin-right: 5px" rows="4" name="remarks" placeholder="Deleting loan requires a reason. Please provide it here.">{{ old('remarks') }}</textarea>
                                            <button class="btn btn-danger pull-right text-uppercase col-md-8" type="submit">Delete</button>
                                        </form>
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
    <!-- Masked Input -->
    <script src="{{ url('js/jquery.mask.js') }}"></script>

    <script>
        @if(session('success'))
        alert('{{ session('success') }}')
        @endif

        $('.money').mask('#,##0.00', {reverse: true})
        $('.date').mask('00/00/0000', {placeholder: "MM/DD/YYYY"})
    </script>
@stop
