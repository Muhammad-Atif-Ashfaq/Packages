<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Pluto - Responsive Bootstrap Admin Panel Templates</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- site icon -->
    <link rel="icon" href="{{ asset('assets/images/fevicon.png') }}" type="image/png" />
    <!-- bootstrap css -->
    <link rel="icon" href="{{ asset('assets/images/fevicon.png') }}" type="image/png" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <!-- site css -->
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}" />
    <!-- responsive css -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" />
    <!-- color css -->
    <link rel="stylesheet" href="{{ asset('assets/css/colors.css') }}" />
    <!-- select bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select.css') }}" />
    <!-- scrollbar css -->
    <link rel="stylesheet" href="{{ asset('assets/css/perfect-scrollbar.css') }}" />
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
</head>

<body class="inner_page login bg-dark">
    <div class="full_container">
        <div class="container">
            <div class="center verticle_center full_height">
                <div class="login_section bg-secondary text-white">
                    <div class="logo_login">
                        <div class="center">
                            <a href="{{ route('home') }}"><img width="210" src="{{ asset('assets/images/logo/logo.png') }}" alt="#" /></a>
                        </div>
                    </div>

                    <div class="login_form">
                       @displayErrors
                        <form method="post" action="{{route('admin.login')}}">
                            @csrf
                            <fieldset>
                                <div class="field">
                                    <label class="label_field">Email Address</label>
                                    <input type="email" name="email" placeholder="E-mail" />
                                </div>
                                <div class="field">
                                    <label class="label_field">Password</label>
                                    <input type="password" name="password" placeholder="Password" />
                                </div>
                                <div class="field">
                                    <label class="label_field hidden">hidden label</label>
                                    <label class="form-check-label"><input type="checkbox" class="form-check-input">
                                        Remember Me</label>
                                    <a class="forgot" href="">Forgotten Password?</a>
                                </div>
                                <div class="field margin_0">
                                    <label class="label_field hidden">hidden label</label>
                                    <button class="main_bt">Sign In</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/js/popper.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
    <!-- wow animation -->
    <script src="{{ asset('assets/js/animate.js')}}"></script>
    <!-- select country -->
    <script src="{{ asset('assets/js/bootstrap-select.js')}}"></script>
    <!-- nice scrollbar -->
    <script src="{{ asset('assets/js/perfect-scrollbar.min.js')}}"></script>
    <script>
    var ps = new PerfectScrollbar('#sidebar');
    </script>
    <!-- custom js -->
    <script src="{{ asset('assets/js/custom.js')}}"></script>
</body>

</html>
