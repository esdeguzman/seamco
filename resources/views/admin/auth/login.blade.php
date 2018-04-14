
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin's Login</title>

    <!-- Bootstrap -->
    <link href={{ url('vendors/bootstrap/dist/css/bootstrap.min.css') }} rel="stylesheet">
    <!-- Font Awesome -->
    <link href={{ url('vendors/font-awesome/css/font-awesome.min.css') }} rel="stylesheet">
    <!-- NProgress -->
    <link href={{ url('vendors/nprogress/nprogress.css') }} rel="stylesheet">
    <!-- Animate.css -->
    <link href={{ url('vendors/animate.css/animate.min.css') }} rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href={{ url('build/css/custom.min.css') }} rel="stylesheet">
</head>

<body class="login">
<div>
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form method="POST" action="{{ url('/admin/login') }}">
                    {{ csrf_field() }}
                    <h1>SEAMCO Admin</h1>
                    <div>
                        <input type="text" class="form-control" placeholder="Username" name="username" />
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" name="password" />
                    </div>
                    <div>
                        <button class="btn btn-default submit">Log in</button>
                        {{--<a class="reset_pass" href="#">Lost your password?</a>--}}
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">New to site?
                            <a href="{{ url('/admin/register') }}" class="to_register"> Create Account </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            {{--<h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>--}}
                            <p>©2018 All Rights Reserved</p>
                            <p>Seafarers Mighty Credit Corporation. Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>

<script>
    @if(session('success'))
    alert('{{ session('success') }}')
    @endif
</script>
</body>
</html>
