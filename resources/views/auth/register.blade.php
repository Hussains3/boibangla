@extends('layouts.master')


@section('content')
    <div class="">
        <div class="checkout-wrapper">
            <div class="checkout-head text-center mb-1">
                <h1>Sign Up</h1>
            </div>
            <div class="">
                <div class="">
                    <div class="customer d-flex flex-wrap justify-content-center">
                        <div id="signpu-form">
                            <div class="" id="">
                                <div class="">
                                    <h3>New Customers</h3>
                                </div>
                                <p>
                                    Create a new account to make future purchases even faster.
                                </p>

                                <form id="customerSignUpForm" action="{{ route('register.perform') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="customer-form mt-1">
                                        <div class="lbl-width">
                                            Name:
                                        </div>
                                        <div>
                                            <input name="name" type="text" id="name" class="new-txt-box" required>
                                        </div>
                                    </div>
                                    <div class="customer-form mt-1">
                                        <div class="lbl-width">
                                            <label for="email">Email</label>
                                            &nbsp;<span id="email-alert"></span>
                                        </div>
                                        <div>
                                            <input name="email" type="email" id="email" class="new-txt-box" required>
                                        </div>
                                    </div>
                                    <div class="customer-form mt-1">
                                        <div class="lbl-width">
                                            <label for="phone">Phone</label>
                                            &nbsp;<span id="phone-alert"></span>
                                        </div>
                                        <div>
                                            <input name="phone" type="text" id="phone" class="new-txt-box" required>
                                        </div>
                                    </div>
                                    <div class="customer-form mt-1">
                                        <div class="lbl-width">
                                            Password:
                                        </div>
                                        <div>
                                            <input name="password" type="password" id="password" class="new-txt-box"
                                                required>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="customer-form mt-1">
                                        <div class="">
                                            <label for="password_confirmation">Confirm Password:</label>
                                            &nbsp;<span id="confirmPass-alert"></span>

                                        </div>
                                        <div>
                                            <input name="password_confirmation" type="password" id="password_confirmation"
                                                class="new-txt-box" required>
                                            <br>


                                        </div>
                                    </div>
                                    <div class="customer-form news-chk mt-1">
                                        <input id="subscribe" type="checkbox" name="subscribe" checked="checked"><label
                                            for="subscribe">Subscribe to Boibangla Newsletter</label>
                                    </div>
                                    <div class="mt-1">
                                        <button type="submit" id="createAccount" class="btn-red">Create Accunt</button>
                                    </div>
                                    <div class="customer-form">
                                        <label id="ctl00_phBody_SignUp_lblmsg" class="error" style="display: none">
                                        </label>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="social-signup">
                            <div class="title">Or sign-in using your existing account with...</div>
                            <div class="account-icon">
                                <a href="{{ route('auth.googleRedirect') }}">
                                    <img src="{{ asset('images/buttons/google-account.gif') }}" alt="Login with Google"
                                        title="Login with Google" onclick="">
                                </a>
                                <a href="{{ route('auth.facebookRedirect') }}">
                                    <img src="{{ asset('images/buttons/fb-account.gif') }}" alt="Login with Facebook"
                                        title="Login with Facebook" onclick="">
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
        $(document).ready(function() {

            var email_state = false;
            var phone_state = false;
            let _token = $('input[name="_token"]').val();

            // signup ajax request
            $("#createAccount").click(function(event) {
                event.preventDefault();

                let name = $("input[name=name]").val();
                let email = $("input[name=email]").val();
                let phone = $("input[name=phone]").val();
                let password = $("input[name=password]").val();
                let password_confirmation = $("input[name=password_confirmation]").val();
                let registerPerform = "{{ route('register.perform') }}";



                console.log(password_confirmation + ' ' + name + ' ' + email + ' ' + phone);
                $.ajax({
                    url: registerPerform,
                    type: "POST",
                    data: {
                        name: name,
                        email: email,
                        phone: phone,
                        password: password,
                        password_confirmation: password_confirmation,
                        _token: _token,
                    },
                    beforeSend:function(){
                        $("#createAccount").attr('disabled',true);
                        $("#createAccount").text('Please wait ... Processing Data');
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status == "accountcreated") {
                            setTimeout(function() {
                                window.location.href = "{{ route('home.index') }}";
                            }, 1000)
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        $("#createAccount").attr('disabled',false);
                        $("#createAccount").text('Create Accunt');
                        $("#customerSignUpForm")[0].reset();
                    }
                });
            });

            //email check----------
            $('#email').on('blur', function() {
                var email = $('#email').val();
                if (email == '') {
                    email_state = false;
                    return;
                }

                $.ajax({
                    url: '{{ route('mailcheck') }}',
                    type: 'post',
                    data: {
                        'email_check': 1,
                        'email': email,
                        _token: _token,
                    },

                    success: function(response) {
                        if (response == 'taken') {
                            email_state = false;
                            $('#email-alert').removeClass("success").addClass("error");
                            $('#email-alert').text('Already taken');
                        } else if (response == 'not_taken') {
                            email_state = true;
                            $('#email-alert').removeClass("error").addClass("success");
                            $('#email-alert').text('Available');
                        }
                    }

                });

            });
            // email check end

            //  phone_number check
            $('#phone').on('blur', function() {
                var phone = $('#phone').val();
                if (phone == '') {
                    phone_state = false;
                    return;
                }

                $.ajax({
                    url: '{{ route('phonecheck') }}',
                    type: 'post',
                    data: {
                        'phone_check': 1,
                        'phone': phone,
                        _token: _token,
                    },
                    success: function(response) {
                        if (response == 'taken') {
                            phone_state = false;
                            $('#phone-alert').removeClass("success").addClass("error");
                            $('#phone-alert').text('Already taken');
                        } else if (response == 'not_taken') {
                            phone_state = true;
                            $('#phone-alert').removeClass("error").addClass("success");
                            $('#phone-alert').text('Available');
                        }
                    }
                });
            });
            // phone check end



            // Password confirmation
            var password = $('#password');
            var passwordConfirm = $('#password_confirmation');
            password.on('blur', function() {
                passWordMatch();
            });

            passwordConfirm.on('blur', function() {
                passWordMatch();
            });

            function passWordMatch() {
                if (password.val() == passwordConfirm.val()) {
                    $('#confirmPass-alert').removeClass("error").addClass("success");
                    $('#confirmPass-alert').text('Matched');

                } else {
                    $('#confirmPass-alert').removeClass("success").addClass("error");
                    $('#confirmPass-alert').text('Didn\'t Match');
                }
            }
            // Password confirmation end


        });
    </script>
@endsection
