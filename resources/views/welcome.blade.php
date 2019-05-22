<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Seamco</title>

    <!-- UIkit JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.35/js/uikit.min.js"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.35/css/uikit.min.css" />
    <script src="https://unpkg.com/sweetalert2@7.0.10/dist/sweetalert2.all.js"></script>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({
              google_ad_client: "ca-pub-6429484135715885",
              enable_page_level_ads: true
         });
    </script>

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }

        .logo {
            height: 300px;
            width: 900px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        img {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="m-b-md logo">
            <img src="{{ url('img/seamco_logo.png') }}">
        </div>

        <div class="links">
            <div class="links uk-float-left" uk-lightbox><a href="{{ url('img/registration_cert.jpg') }}">Registration Certificate</a></div>
            <a href="{{ url('member/register') }}">Create an Account!</a>
            <a href="{{ url('member/login') }}">I have an Account</a>
            <a href="{{ url('admin/login') }}">I am an Admin</a>
            <a href="#modal-overflow" uk-toggle>Terms and Conditions</a>
        </div>
    </div>
</div>

<div id="modal-overflow" uk-modal>
    <div class="uk-modal-dialog">

        <button class="uk-modal-close-default" type="button" uk-close></button>

        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Terms and Conditions</h2>
        </div>

        <div class="uk-modal-body" uk-overflow-auto>

            <p class="uk-text-bold">
                I hereby apply for membership in <span class="uk-text-primary">SEAFARERS MIGHTY CREDIT COOPERATIVE</span> (<strong>SEAMCO</strong>) and agree to faithfully obey its rules and regulation as set down in its by-laws and amendments thereof and the decision of the general membership as well as those of the directors. <br><br>
                I hereby pledge to subscribe <strong>TWO HUNDRED FIFTY</strong> (<strong>250</strong>) <strong>SHARES</strong> with a total value of <strong>TWENTY-FIVE THOUSAND PESOS</strong> (<strong>25,000.00</strong>). I also pledge to pay <em>at least twenty-five percent (25%)</em> of my subscription and <strong>ONE THOUSAND PESOS</strong> (<strong>1,000.00</strong>) membership fee upon this application. <br><br>
                I agree that the <em>minimum monthly contribution</em> to the share capital is <strong>FIVE HUNDRED PESOS</strong> (<strong>500.00</strong>) and I will continue to pay this amount until I have paid <strong>TWENTY-FIVE THOUSAND PESOS</strong> (<strong>25,000.00</strong>). Payments made by me in excess of my share capital of P25, 000.00 will be considered as my savings deposits. <br><br>
                It is understood that <em>I cannot withdraw</em> my share capital during my membership. In case of withdrawal of membership the <em>amount of P1000.00 shall be retained</em> from my share capital and will be credited to withdrawal income of <strong>SEAMCO</strong> should I fail to revive my membership within 12 months by putting up a fresh share capital. <br><br>
                It is finally understood that withdrawal of membership is subject for the approval of the <strong>Board of Directors</strong> prior release of my share capital.
            </p>

        </div>

        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Close</button>
            <a class="uk-button uk-button-primary" href="{{ url('member/register') }}">Continue to registration page</a>
        </div>

    </div>
</div>

<script>
    @if(session('success'))
    swal(
        'Heads up!',
        '{{ session('success') }}',
        'info'
    )
    @endif
</script>
</body>
</html>
