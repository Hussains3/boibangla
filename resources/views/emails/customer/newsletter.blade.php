
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ejhuli Newsletter</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <style>
        *{
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }
        html,body{
            background: #eeeeee;
            font-family: 'Open Sans', sans-serif, Helvetica, Arial;
        }
        img{
            max-width: 100%;
        }
        /* This is what it makes reponsive. Double check before you use it! */
        @media only screen and (max-width: 480px){
            table tr td{
                width: 100% !important;
                float: left;
            }
        }
    </style>
</head>

<body style="background: #eeeeee; padding: 10px; font-family: 'Open Sans', sans-serif, Helvetica, Arial;">
<center>
    <img src="{{ asset('assets/images/admin_website_logo.png') }}"/>
    <!-- ** Table begins here
    ----------------------------------->
    <!-- Set table width to fixed width for Outlook(Outlook does not support max-width) -->
    <table width="100%" cellpadding="0" cellspacing="0" bgcolor="FFFFFF" style="background: #ffffff; max-width: 600px !important; margin: 0 auto; background: #ffffff;">
        <tr>
            <td style="padding: 20px; text-align: center; background: #FF324D;">
                <h1 style="color: #ffffff">Boibangla Newsletter</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <p style="font-size:30px; margin: 5px;text-align:center">{{ $newsletter['title'] }}</p>
                <p>
                    Dear subscriber, <br/>
                    {{ $newsletter['description'] }}
                </p>
               <center>
                   <p style="border-radius: 40px; -moz-border-radius: 40px; padding: 15px 20px; margin: 10px auto; background: #FF324D; display: inline-block;">
                       <a href="{{ $newsletter['call_to_action'] }}" style="color: #fff; text-decoration: none;">Visit ejhuli.com</a>
                   </p>
               </center>
            </td>
        </tr>
        <tr>
            <td>
                <img src="{{ $newsletter['image'] }}" width="880" height="420" />
            </td>
        </tr>
        
    </table>
    <p style="text-align: center; color: #666666; font-size: 12px; margin: 10px 0;">
        Copyright © 2021. All&nbsp;rights&nbsp;reserved.<br />
        If you do not want to receive emails from us, you can <a href="#" target="_blank">unsubscribe</a>.
    </p>
</center>
</body>
</html>
