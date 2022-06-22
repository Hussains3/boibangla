<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="" type="image/ico" />
    <title>Login</title>
    <!-- Bootstrap -->
    <link href="{{asset('theme/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('theme/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('theme/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{asset('theme/vendors/animate.css/animate.min.css')}}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{asset('theme/vendors/build/css/custom.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/busy.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
    <script>
        let BASE_URL = {!! json_encode(url('/')) !!}+"/";
        console.log(BASE_URL);
    </script>

</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form id="loginForm">
                    <h1 style="line-height: 30px;">Admin</h1>
                    <div class="login-failed" style="display:none;">

                    </div>
                    <div>
                        <input type="text" class="form-control" name="mobileNumber" id="mobileNumber" maxlength="10" placeholder="Enter your mobile" />
                    </div>
                    <div>
                        <input type="password" class="form-control" name="password" id="password"   placeholder="Enter your password"/>
                    </div>
                    <div>
                        <button class="btn btn-default btn-sm ">Log in</button>
                    </div>

                    <div class="clearfix"></div>
                    <div class="separator">
                        <p class="change_link">
                            <a href="#" class="to_register">Lost your password? </a>
                        </p>
                        <div class="clearfix"></div>
                        <br />
                        <div>
                            <p>©2019 All Rights Reserved. Designed & Developed by<br/> <span><img src="https://codingbirdsonline.com/wp-content/uploads/2020/01/cropped-coding-birds-online-favicon-180x180.png" width="15"></span> <a href="https://cubersindia.com/" target="_blank">CodingBirdsOnline</a> </p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>

    <div class="modal-busy" id="loader" style="display: none">
        <div class="center-busy">
            {{--<img alt="" src="{{asset('assets/images/loaders/ajax-loading.gif')}}" />--}}
            <div class="spinner-dark"></div>
        </div>
    </div>
    <script src="{{asset('theme/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/admin/login/admin-login.js')}}"></script>

</div>
</body>
</html>

