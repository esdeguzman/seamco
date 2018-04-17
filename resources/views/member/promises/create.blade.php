@extends('member.layout.main')

@section('page-title') | Create Promises @stop

@section('page-content')
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Create Promises</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />

                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <label>Principal Amount</label>
                            <span class="help-block">P {{ number_format($promissoryNote->principal_amount, 2) }}</span>
                        </div>

                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <label>Interest</label>
                            <span class="help-block">P {{ number_format($promissoryNote->interest, 2) }}</span>
                        </div>

                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <label>Total Amount to be Paid</label>
                            <span class="help-block">P {{ number_format($promissoryNote->principal_amount + $promissoryNote->interest, 2) }}</span>
                        </div>

                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <label>Payment Due</label>
                            <span class="help-block">{{ \Carbon\Carbon::parse($promissoryNote->creditEvaluation->estimated_date_release)->addMonths($promissoryNote->terms)->toFormattedDateString() }}</span>
                        </div>
                        <br>
                        <br><br><br>

                        <form class="form-horizontal form-label-left" action="{{ route('promises.store', $promissoryNote->id) }}" method="post">
                            {{ csrf_field() }}
                            @for($i = 0; $i < $promissoryNote->terms * 2; $i++)
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <input type="text" class="form-control has-feedback-left date" placeholder="Due Date" name="due_date_{{ $i }}" value="{{ old('due_date_' . $i) }}" />
                                <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <input type="text" class="form-control money" placeholder="Amount" name="amount_{{ $i }}" value="{{ old('amount_' . $i) }}">
                                <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
                            </div>
                            @endfor

                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                    {{--<button type="button" class="btn btn-warning pull-right">Cancel</button>--}}
                                    <button class="btn btn-primary pull-right" type="reset">Reset</button>
                                    <button type="submit" class="btn btn-success pull-right">Submit</button>
                                </div>
                            </div>

                        </form>
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
        $('.date').mask('00/00/0000', {placeholder: "MM/DD/YYYY"})

        $('.money').mask('#,##0.00', {reverse: true})
    </script>
@stop