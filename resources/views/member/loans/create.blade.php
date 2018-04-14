@extends('member.layout.main')

@section('page-title') | Apply for Loan @stop

@section('page-content')
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Loan Application Form</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form class="form-horizontal form-label-left" action="{{ route('loans.store', \Illuminate\Support\Facades\Auth::guard('member')->user()->id) }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label>Input amount to be loaned beside its category.</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="regular">Regular</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="regular" class="form-control col-md-7 col-xs-12 money" name="regular" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="short_term">Short Term</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="short_term" class="form-control col-md-7 col-xs-12 money" name="short_term" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pre_joining">Pre-Joining</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="pre_joining" class="form-control col-md-7 col-xs-12 money" name="pre_joining" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productive">Productive</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="productive" class="form-control col-md-7 col-xs-12 money" name="productive" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="special">Special</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="special" class="form-control col-md-7 col-xs-12 money" name="special" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="appliance">Appliance</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="appliance" class="form-control col-md-7 col-xs-12 money" name="appliance" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="petty_cash">Petty Cash</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="petty_cash" class="form-control col-md-7 col-xs-12 money" name="petty_cash" />
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Payment Terms</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="radio" class="uk-radio uk-disabled" name="payment_terms" value="6" id="6"> <label for="6">6 Months</label>
                                    <input type="radio" class="uk-radio uk-disabled" name="payment_terms" value="12" id="12"> <label for="12">12 Months</label>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Additional Information</label>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="member_id">Comaker</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="comaker_id" id="member_id" class="form-control">
                                        <option hidden>Select Comaker</option>
                                        @foreach($comakers as $comaker)
                                        @if($comaker->id == \Illuminate\Support\Facades\Auth::guard('member')->user()->id)
                                        @else
                                            <option value="{{ $comaker->id }}">{{ $comaker->full_name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_contact_number">Company Contact Number</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="company_contact_number" class="form-control col-md-7 col-xs-12" name="company_contact_number" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="monthly_income">Monthly Income</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="monthly_income" class="form-control col-md-7 col-xs-12 money" name="monthly_income" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="take_home_pay">Take Home Pay</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="take_home_pay" class="form-control col-md-7 col-xs-12 money" name="take_home_pay" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sss_gsis">SSS / GSIS</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="sss_gsis" class="form-control col-md-7 col-xs-12" name="sss_gsis" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="residence_telephone_number">Residence Telephone Number</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="residence_telephone_number" class="form-control col-md-7 col-xs-12" name="residence_telephone_number" />
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-primary" type="button">Cancel</button>
                                    <button class="btn btn-success" type="submit">Apply for Loan</button>
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
    $('.money').mask('#,##0.00', {reverse: true})

    @if(session('error'))
    alert('{{ session('error') }}')
    @endif
</script>
@stop