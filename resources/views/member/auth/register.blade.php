<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register | Seamco</title>

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.35/css/uikit.min.css" />
    <!-- Material Color Palette -->
    <link rel="stylesheet" href="{{ url('css/material-design-color-palette.min.css') }}" />

    <!-- UIkit JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.35/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.35/js/uikit-icons.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.0.10/dist/sweetalert2.all.js"></script>
    <script src="{{ url('css/fontawesome/fontawesome.min.css') }}"></script>
</head>

<body>
<div class="uk-child-width-expand@s uk-padding-large" uk-grid>
    <div>
        <h1 class="uk-margin-medium-top uk-text-bold">Membership Application</h1>
        <p class="uk-align-justify uk-margin-large-top">
            I hereby apply for membership in <span class="uk-text-primary">SEAFARERS MIGHTY CREDIT COOPERATIVE</span> (<strong>SEAMCO</strong>) and agree to faithfully obey its rules and regulation as set down in its by-laws and amendments thereof and the decision of the general membership as well as those of the directors. <br><br>
            I hereby pledge to subscribe <strong>TWO HUNDRED FIFTY</strong> (<strong>250</strong>) <strong>SHARES</strong> with a total value of <strong>TWENTY-FIVE THOUSAND PESOS</strong> (<strong>25,000.00</strong>). I also pledge to pay <em>at least twenty-five percent (25%)</em> of my subscription and <strong>ONE THOUSAND PESOS</strong> (<strong>1,000.00</strong>) membership fee upon this application. <br><br>
            I agree that the <em>minimum monthly contribution</em> to the share capital is <strong>FIVE HUNDRED PESOS</strong> (<strong>500.00</strong>) and I will continue to pay this amount until I have paid <strong>TWENTY-FIVE THOUSAND PESOS</strong> (<strong>25,000.00</strong>). Payments made by me in excess of my share capital of P25, 000.00 will be considered as my savings deposits. <br><br>
            It is understood that <em>I cannot withdraw</em> my share capital during my membership. In case of withdrawal of membership the <em>amount of P1000.00 shall be retained</em> from my share capital and will be credited to withdrawal income of <strong>SEAMCO</strong> should I fail to revive my membership within 12 months by putting up a fresh share capital. <br><br>
            It is finally understood that withdrawal of membership is subject for the approval of the <strong>Board of Directors</strong> prior release of my share capital.
        </p>

        <div class="uk-margin-large-top">
            <label class="uk-text-small"><input class="uk-checkbox terms" type="checkbox" name="terms_and_conditions" @if(old('terms_and_conditions')) checked @endif> I hereby state that I have read, understand and accept the terms and conditions above.</label>
        </div>

        <button class="uk-button uk-button-default uk-float-right uk-margin-large-top">Continue Application</button>
    </div>
    <div class="uk-grid-item-match">
        <div class="uk-card uk-card-default uk-card-body uk-padding-remove-top">
            <h3 class="mdc-bg-amber-900 uk-padding-small uk-margin mdc-text-white-darker" style="position: absolute; left: 0; right: 0">Applicant Information</h3><br><br><br>
            <form class="uk-grid-small" uk-grid action="{{ url('member/register') }}" method="post">
                {{ csrf_field() }}
                <div class="uk-width-2-3@s">
                    <label>Full Name</label>
                    <input class="uk-input {{ $errors->has('full_name') ? 'uk-form-danger' : '' }}" type="text" name="full_name" value="{{ old('full_name') }}">
                </div>
                <div class="uk-width-1-3@s">
                    <label>Civil Status</label>
                    <select class="uk-select {{ $errors->has('civil_status') ? 'uk-form-danger' : '' }}" name="civil_status">
                        <option value="" hidden>Select here</option>
                        <option value="single" @if(old('civil_status') == 'single') selected @endif>Single</option>
                        <option value="married" @if(old('civil_status') == 'married') selected @endif>Married</option>
                        <option value="widow" @if(old('civil_status') == 'widow') selected @endif>Widow</option>
                        <option value="prefer not to say" @if(old('civil_status') == 'prefer_not_to_say') selected @endif>Prefer not to say</option>
                    </select>
                </div>
                <div class="uk-width-1-3@s">
                    <label>Date of Birth</label>
                    <input class="uk-input date {{ $errors->has('birth_date') ? 'uk-form-danger' : '' }}" type="text" name="birth_date" value="{{ old('birth_date') }}">
                </div>
                <div class="uk-width-1-3@s">
                    <label>Mobile Number</label>
                    <input class="uk-input mobile {{ $errors->has('mobile_number') ? 'uk-form-danger' : '' }}" type="text" name="mobile_number" value="{{ old('mobile_number') }}">
                </div>
                <div class="uk-width-1-3@s">
                    <label>Gender</label>
                    <select class="uk-select {{ $errors->has('gender') ? 'uk-form-danger' : '' }}" name="gender">
                        <option value="" hidden>Select here</option>
                        <option value="male" @if(old('gender') == 'male') selected @endif>Male</option>
                        <option value="female" @if(old('gender') == 'female') selected @endif>Female</option>
                        <option value="prefer not to say" @if(old('gender') == 'prefer not to say') selected @endif>Prefer not to say</option>
                    </select>
                </div>
                <div class="uk-width-1-1@s">
                    <label>Present Address</label>
                    <input class="uk-input {{ $errors->has('present_address') ? 'uk-form-danger' : '' }}" type="text" name="present_address" value="{{ old('present_address') }}">
                </div>
                <div class="uk-width-1-1@s">
                    <label>Permanent Address</label>
                    <input class="uk-input {{ $errors->has('permanent_address') ? 'uk-form-danger' : '' }}" type="text" name="permanent_address" value="{{ old('permanent_address') }}">
                </div>
                <div class="uk-width-1-2@s">
                    <label>Employer</label>
                    <input class="uk-input {{ $errors->has('employer') ? 'uk-form-danger' : '' }}" type="text" name="employer" value="{{ old('employer') }}">
                </div>
                <div class="uk-width-1-2@s">
                    <label>Tax Identification Number</label>
                    <input class="uk-input tin {{ $errors->has('tax_identification_number') ? 'uk-form-danger' : '' }}" type="text" name="tax_identification_number" value="{{ old('tax_identification_number') }}">
                </div>
                <div class="uk-width-1-2@s">
                    <label>Position</label>
                    <input class="uk-input {{ $errors->has('position') ? 'uk-form-danger' : '' }}" type="text" name="position" value="{{ old('position') }}">
                </div>
                <div class="uk-width-1-2@s">
                    <label>Department</label>
                    <input class="uk-input {{ $errors->has('department') ? 'uk-form-danger' : '' }}" type="text" name="department" value="{{ old('department') }}">
                </div>
                <div class="uk-width-2-3@s">
                    <label>Date of Employment</label>
                    <input class="uk-input date {{ $errors->has('employment_date') ? 'uk-form-danger' : '' }}" type="text" name="employment_date" value="{{ old('employment_date') }}">
                </div>
                <div class="uk-width-1-3@s">
                    <label>Salary</label>
                    <input class="uk-input salary {{ $errors->has('salary') ? 'uk-form-danger' : '' }}" type="text" name="salary" value="{{ old('salary') }}">
                </div>
                <div class="uk-width-1-1@s">
                    <label>Address of Employer</label>
                    <input class="uk-input {{ $errors->has('employer_address') ? 'uk-form-danger' : '' }}" type="text" name="employer_address" value="{{ old('employer_address') }}">
                </div>
                <div class="uk-width-1-2@s">
                    <label>Other Source of Income</label>
                    <input class="uk-input {{ $errors->has('other_source_of_income') ? 'uk-form-danger' : '' }}" type="text" name="other_source_of_income" value="{{ old('other_source_of_income') }}">
                </div>
                <div class="uk-width-1-2@s">
                    <label>Number of Dependents</label>
                    <input class="uk-input dependents {{ $errors->has('number_of_dependents') ? 'uk-form-danger' : '' }}" type="text" name="number_of_dependents" value="{{ old('number_of_dependents') }}">
                </div>
                {{--<div class="uk-width-1-1@s">--}}
                    {{--<label>Paid Amount</label>--}}
                    {{--<input class="uk-input salary" type="text" name="amount" value="{{ old('amount') }}">--}}
                    {{--@if($errors->amount) <span class="uk-text-danger uk-text-small">{{ $errors->first() }}</span> @endif--}}
                {{--</div>--}}
                <label class="uk-align-center uk-margin-medium-top uk-text-primary uk-text-bold">Thrift. Respect. Unity. Service. Transparency.</label>
            </form>
        </div>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<!-- Masked Input -->
<script src="{{ url('js/jquery.mask.js') }}"></script>
<script>
    $('.date').mask('00/00/0000', {placeholder: "MM/DD/YYYY"})
    $('.mobile').mask('+63000-0000-000', {placeholder: "+63___-____-___"})
    $('.tin').mask('000-000-000-000', {placeholder: "___-___-___-___"})
    $('.salary').mask('#,##0.00', {reverse: true})
    $('.dependents').mask('000')

    $('button').on('click', function() {
        $('form').append($('.terms').clone())
        $('form').submit()
    })

    @if($errors->has('terms_and_conditions'))
    swal(
        'Woah!',
        'Forgot to read the Terms and Conditions?',
        'error'
    )
    @elseif(count($errors->all()) > 0)
    swal(
        'Oh Dear!',
        'You have to complete the application form first.',
        'error'
    )
    @endif
</script>
</html>