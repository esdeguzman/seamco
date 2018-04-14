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
                        <form class="form-horizontal form-label-left">

                            @for($i = 0; $i < 12; $i++)
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <input type="text" class="form-control has-feedback-left date" placeholder="Due Date" name="due_date_{{ $i }}" />
                                <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <input type="text" class="form-control money" placeholder="Amount" name="amount_{{ $i }}">
                                <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
                            </div>
                            @endfor

                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                    <button type="button" class="btn btn-warning pull-right">Cancel</button>
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