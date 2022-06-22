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
                <center>
                    <img src="{{ asset('assets/images/admin_website_logo.png') }}"/>
                </center>
                @yield('admin_mail_content')
            </div>
        </td>
        <td>&nbsp;</td>
    </tr>
</table>
</body>
</html>
