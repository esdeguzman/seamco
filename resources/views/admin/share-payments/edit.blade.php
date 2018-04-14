@extends('admin.layout.main')

@section('page-title') | Share Payment @stop

@section('page-content')
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Share Payment Information</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form class="form-horizontal form-label-left" action="{{ route('share-payment.update', $sharePayment->member_id) }}" method="post">
                            {{ csrf_field() }} {{ method_field('put') }}
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label class="text-capitalize">received by: </label> <label class="text-uppercase text-primary">{{ $sharePayment->receivedBy->first_name }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label class="text-capitalize">amount: </label> <label class="text-uppercase text-primary">{{ number_format($sharePayment->amount, 2) }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label class="text-capitalize">share balance: </label> <label class="text-uppercase text-primary">{{ number_format($sharePayment->share_balance, 2) }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label class="text-capitalize">savings: </label> <label class="text-uppercase text-primary">{{ number_format($sharePayment->savings, 2) }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount"></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="remarks" rows="5" class="form-control" style="resize: none"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount"></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <button class="btn btn-block btn-primary">ADD REMARKS TO SHARE PAYMENT</button>
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
    <script src="{{ url('js/jquery.mask.js') }}"></script>

    <script>
        $('.money').mask('#,##0.00', {reverse: true})
    </script>
@stop