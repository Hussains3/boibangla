<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Welcome to ShopZEN</title>
    @include('emails.css.mailer-css')
</head>
<body class="">
<table border="0" cellpadding="0" cellspacing="0" class="body">
    <tr>
        <td>&nbsp;</td>
        <td class="container">
            <div class="content">
                <center>
                    <img src="{{ asset('assets/images/admin_website_logo.png') }}"/>
                </center>
                <span class="preheader">Password Reset Request</span>
                <table class="main">
                    <tr>
                        <td class="wrapper">
                            <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <p>Hi, {{$customer->first_name}}! # {{ $customer->username }}</p>
                                        <p>We have received a password reset request. If this was done by mistake,ignore this.<br/>
                                        If you want to change this password,Click on the create password</p>
                                        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                            <tbody>
                                            <tr>
                                                <td align="left">
                                                    <table border="0" cellpadding="0" cellspacing="0">
                                                        <tbody>
                                                        <tr>
                                                            <td><a href="{{route('setupPassword',[$token])}}" target="_blank">Create Password</a></td>
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
                                <span class="apple-link">38/2 Kha,Mannan market(2nd floor),Banglabazar,Dhaka-1100</span>
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
