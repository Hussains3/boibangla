@extends('profile.dashboard-master')


@section('dashboard-wraper')


<div id="ps" class="ac-content">
   <div class="title">
      Change Password
   </div>
   <div class="main-accout-table">
      <div id="plnPwd" onkeypress="javascript:return WebForm_FireDefaultButton(event, 'imgSubmit')">
        <form action=""  id="passwordUpdateForm">
         <div class="myaccount-form">
            <div class="customer-form">
               <div class="name-fild" style="margin: 0 5px 0 0;">
                  Email Address:
               </div>
               <div class="input-fild">
                  <strong>
                  <span id="lblEmail">{{$user->email}}</span></strong>
               </div>
               <div class="clearfloat">
               </div>
            </div>
            <div class="customer-form">
               <div class="name-fild mandatory">
                  Current Password:
               </div>
               <div class="input-fild">
                  <input name="current_password" type="password" id="current_password" style=" ">
                  <br>
               </div>
               <div id="current_passwordError" class="error"></div>
            </div>
            <div class="customer-form">
               <div class="name-fild mandatory">
                  New Password:
               </div>
               <div class="input-fild">
                  <input name="new_password" type="password" id="new_password" style=" ">
                  <br>
               </div>
               <div id="new_passwordError" class="error"></div>
            </div>
            <div class="customer-form">
               <div class="name-fild mandatory">
                  Confirm Password:
               </div>
               <div class="input-fild">
                  <input name="confirm_password" type="password" id="confirm_password" style="">
               </div>
               <div id="confirm_passwordError" class="error"></div>
            </div>
            <div class="form-btn">
               <span id="lblmsg" class="errormsg"></span>
            </div>
            <div class="form-btn">
                <input type="hidden" name="currentPasswordStatus" id="currentPasswordStatus" value="verify"/>
                <button type="submit" id="updatePasswordBtn" class="btn-red btn-fill-out btn-block">Change Password</button>
            </div>
         </div>
        </form>
      </div>
   </div>
   <div style="width: 98.5%; text-align: center; padding-top: 10px;"></div>
</div>


@endsection
@section('script')
    <script src="{{asset('assets/js/customer/password/password-update.js')}}" type="text/javascript"></script>
@endsection
