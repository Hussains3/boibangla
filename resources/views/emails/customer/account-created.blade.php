<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Welcome to {{ config('app.name') }}</title>
    @include('emails.css.mailer-css')
</head>
<body class="">
<table border="0" cellpadding="0" cellspacing="0" class="body">
    <tr>
        <td>&nbsp;</td>
        <td class="container">
            <div class="content">
                <span class="preheader">Welcome to {{ config('app.name') }}, explore the products whatever you want in a cheap price</span>
                <center>
                    <img src="{{ asset('assets/images/admin_website_logo.png') }}"/>
                </center>
                <table class="main">
                    <tr>
                        <td class="wrapper">
                            <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <p>Hi, {{$customer->first_name}}  Explore the Books whatever you want in a cheap price!</p>
                                        <p>Welcome to {{ config('app.name') }}</p>
                                        {{-- We request you to please verify your account. Explore the products whatever you want in a cheap price --}}

                                        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                            <tbody>
                                            <tr>
                                                <td align="left">
                                                    <table border="0" cellpadding="0" cellspacing="0">
                                                        <tbody>
                                                        <tr>
                                                            {{-- <td><a href="{{route('accountVerify',[$token])}}" target="_blank">Verify Account</a></td> --}}
                                                            <td><a href="{{route('home.index')}}" target="_blank">Explore</a></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        @lang('common.contact_for_query')
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <div class="footer" style="display: none">
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="content-block">
                                <span class="apple-link">ShopZEN, 3 Abbey Road,Bangladesh</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </td>
        <td>&nbsp;</td>
    </tr>
</table>
</body>
</html>
