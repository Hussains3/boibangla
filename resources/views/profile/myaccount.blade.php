@extends('profile.dashboard-master')


@section('dashboard-wraper')
    <div id="ps" class="ac-content">
        <div class="title">
            Personal Settings
        </div>
        <div class="myaccount-form">
            <div class="customer-form">
                <div style="margin: 0 5px 0 0;" class="name-fild">
                    Name:
                </div>
                <div class="input-fild">
                    <label>{{$user->name}}</label>
                </div>
                <div class="clearfloat">
                </div>
            </div>
            <div class="customer-form">
                <div style="margin: 0 5px 0 0;" class="name-fild">
                    Email:
                </div>
                <div class="input-fild">
                    <label>
                        {{$user->email}}</label>
                </div>
                <div class="clearfloat">
                </div>
            </div>
            <div class="customer-form">
                <div style="margin: 0 5px 0 0;" class="name-fild">
                    Mobile:
                </div>
                <div class="input-fild">
                    <label>{{$user->phone}}</label>
                </div>
                <div class="clearfloat">
                </div>
            </div>

            <div class="customer-form">
                <div style="margin: 0 5px 0 0;" class="name-fild">
                    Password:
                </div>
                <div class="input-fild">
                    <label>********</label>
                </div>
                <div class="clearfloat">
                </div>
            </div>
            <div class="form-btn">
                <a href="{{route('editmyaccount')}}"><button class="btn-red" id="edit">Edit</button></a>

            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $(".fadeinout").delay(50).fadeIn(800);
        $(".fadeinout").delay(3000).fadeOut(800);
    });
</script>
@endsection

