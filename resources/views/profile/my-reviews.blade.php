@extends('profile.dashboard-master')


@section('dashboard-wraper')


<div id="ps" class="ac-content">
    <div class="title">
       <label id="ctl00_phBody_lblheading">My Reviews</label>
    </div>
</div>


@endsection
@section('script')

<script>
    function ClosePopup() {
    document.getElementById('ctl00_phBody_AccountSetting_fvCustomer_plnOTP').style.display = "none";
    }
</script>

@endsection

