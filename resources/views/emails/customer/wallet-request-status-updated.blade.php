@extends('emails.email-layout')
@section('admin_mail_content')
<span class="preheader">Dear Customer, Your wallet request <b>#{{ $walletRequest->request_id }}</b>
    has been {{ $status == 3 ? 'Archived': 'Approved' }}</span>
<table class="main">
    <tr>
        <td class="wrapper">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <p>Dear Customer,</p>
                        <p>Your wallet request <b>#{{ $walletRequest->request_id }}</b> has been {{ $status == 3 ? 'Archived': 'Approved' }} for the amount of <b>৳{{ $walletRequest->amount }}</b></p>
                        <p>To check your wallet balance click on the following button</p>
                        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                            <tbody>
                            <tr>
                                <td align="left">
                                    <table border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td><a href="{{ route('viewCustomerDashboard') }}" target="_blank">Check Wallet</a></td>
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
