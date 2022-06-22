@extends('layouts.master')


@section('content')

<div class="">
    <div class="checkout-wrapper p-1">
        <div class="checkout-head text-center mb-1">
            <h1>Log In</h1>
        </div>
        <div class="">
            <div class="">
                <div class="customer d-flex flex-wrap justify-content-center">
                    <div id="signpu-form">
                        <div class="" id="">
                            <div class="">
                                <h3>Existing Customers </h3>
                            </div>
                            <p>
                                If you already have an account, please sign in for faster checkout.
                                <a href="{{route('register.show')}}">Create a new account</a>
                            </p>
                            <p class="error" id="response"></p>

                            <form id="customerLogInForm">
                                @csrf


                                <div class="customer-form ">
                                    <div class="lbl-width">
                                        <label for="email">Email or Phone</label>
                                        &nbsp;<span id="email-alert"></span>
                                    </div>
                                    <div>
                                        <input name="username" type="text" id="username" class="new-txt-box" required>
                                    </div>
                                </div>
                                <div class="customer-form ">
                                    <div class="lbl-width">
                                        Password:
                                    </div>
                                    <div>
                                        <input name="password" type="password" id="password" class="new-txt-box" required>
                                        <br>
                                    </div>
                                </div>
                                <div class="customer-form  news-chk" style="margin-top: 10px;">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="rememberMeCheckBox">
                                    <label class="form-check-label" for="rememberMeCheckBox"><span>Remember me</span></label>
                                </div>
                                <div class="customer-form  news-chk" style="margin-top: 10px;">
                                    <a href="{{route('resetPassword')}}">Forgot password?</a>
                                </div>
                                <div class="mt-1 ">
                                    <button id="login" class="btn-red ">Login</button>
                                </div>
                                <div class="customer-form ">
                                    <label id="ctl00_phBody_SignUp_lblmsg" class="error" style="display: none">
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="social-signup">
                        <div class="title">Or sign-in using your existing account with...</div>
                        <div class="account-icon">
                            <a href="{{route('auth.googleRedirect')}}">
                                <img src="{{asset('images/buttons/google-account.gif')}}" alt="Login with Google" title="Login with Google" onclick="">
                            </a>
                            <a href="{{route('auth.facebookRedirect')}}">
                                <img src="{{asset('images/buttons/fb-account.gif')}}" alt="Login with Facebook" title="Login with Facebook" onclick="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



@section('script')
<script>
    $(document).ready(function () {

        let _token = $('input[name="_token"]').val();

        // signup ajax request
        $("#login").click(function(event){
            event.preventDefault();
            let username = $("input[name=username]").val();
            let password = $("input[name=password]").val();
            $.ajax({
                url: "{{route('login.perform')}}",
                type:"POST",
                data:{
                    username:username,
                    password:password,
                    _token: _token,
                },
                beforeSend:function(){
                    $("#login").attr('disabled',true);
                    $("#login").text('Please wait ... Processing Data');
                    $("#loginBtnLoader").removeClass('d-none');
                },
                success:function(response){
                    console.log(response.status);
                    if (response.status == "success") {
                        setTimeout(function () {
                            window.location.href = "{{route('home.index')}}";
                        },500)
                    }else{
                        $('#response').text('Email/Phone  or Password Incorrect');
                        $("#login").attr('disabled',false);
                    }
                },
                error: function(error) {
                    console.log(response);
                    $('#response').text('Email/Phone  or Password Incorrect');
                    $("#login").attr('disabled',false);
                    $("#login").text('Login');
                    $("#customerLogInForm")[0].reset();
                }
            });//ajax


        });//on submit click


    });//doc ready

</script>
@endsection
