@extends('emails.email-layout')
@section('admin_mail_content')
<span class="preheader">A wallet request has been received</span>
<table class="main">
    <tr>
        <td class="wrapper">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <p>Dear Admin,</p>
                        <p>A Wallet request <b>#{{ $wallerRequestId }}</b> has been received for the amount of <b>৳{{ $data->wallet_amount }}</b> <br/>
                            by <b>{{ $customer->first_name }}</b>
                           To take an action click on the following button</p>
                        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                            <tbody>
                            <tr>
                                <td align="left">
                                    <table border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td><a href="{{ route('viewWalletRequests') }}" target="_blank">Check Details</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
@endsection
