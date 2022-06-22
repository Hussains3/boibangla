@extends('layouts.master')
@section('title','Contact Us')
@section('content')
    <div class="artical-main">
        <h1 class="contact-headng">Contact Us</h1>
        <div class="contact-main">
            <div class="contact-details">
                <h2>Your Contact Details:</h2>
                <div class="box">
                <p style="color:#bc3232;padding: 10px 8px;background-color: #d7f2ef;" class="d-none" id="popupNotification"></p>

                    <form action="{{route('contactUs')}}" method="POST" id="contactForm">
                        @csrf
                        <p>
                        Please fill up the form below to send us a message. We will contact you very soon.
                        </p>
                        <div class="cont-main-frm">
                        <div class="contact-frm name-field">
                            <div class="namefild mandatory">
                                Name:
                            </div>
                            <div class="inputs">
                                <input name="name" type="text" maxlength="50" id="name" class="frm-text" required>
                                <span id="ctl00_phBody_ContactUs_rfvfirstname" class="error" style="vertical-align:top;display:none;">Required</span>
                            </div>
                        </div>
                        <div class="contact-frm name-field">
                            <div class="namefild mandatory">
                                Phone:
                            </div>
                            <div class="inputs">
                                <input name="phone" type="text" maxlength="11" id="phone" class="frm-text" minlength="11">
                                <span id="ctl00_phBody_ContactUs_rfvfirstname" class="error" style="vertical-align:top;display:none;">Required</span>
                            </div>
                        </div>
                        <div class="contact-frm email-field">
                            <div class="namefild mandatory">
                                Email Id:
                            </div>
                            <div class="inputs">
                                <div style="float: left; width: 75%" class="emailboxnew">
                                    <input name="email" type="email" value="" maxlength="100" id="email" class="frm-text" required>
                                    <span id="ctl00_phBody_ContactUs_revEmal" style="display:none;">Invalid Email.</span>
                                </div>
                            </div>
                        </div>
                        <div class="contact-frm">
                            <div class="namefild">
                                Subject:
                            </div>
                            <div class="inputs">
                                <input name="subject" type="text" maxlength="50" id="subject" class="frm-text" required>
                                <span id="ctl00_phBody_ContactUs_rfvEmail" class="error" style="vertical-align:top;display:none;">Required</span>

                            </div>
                        </div>
                        <div class="contact-frm desc-field">
                            <div class="namefild mandatory">
                                Description:
                            </div>
                            <div class="inputs">
                                <textarea name="message" rows="1" cols="23" id="message" class="frm-text" required maxlength="1000" minlength="5"></textarea>
                                <span id="ctl00_phBody_ContactUs_rfvDesc" class="error" style="vertical-align:top;display:none;">Required</span>
                            </div>
                        </div>
                        <div class="contact-frm submt-btn">
                            <div class="same-for-billing">
                                <button class="btn-red" type="submit" id="contactusSendbtn">Send</button>
                            </div>
                        </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="row pt-3 contacttextmobile">
                <div class="col-sm-6">
                    <p style="line-height: 30px;"><strong>Address:</strong> <br>Boi Bangla.com.bd<br> 38/2 Kha,Mannan market(2nd floor), <br>Banglabazar,Dhaka-1100</p>
                </div>
                <div class="col-sm-6">
                    <p style="line-height: 30px;">
                    <i class="fas fa-envelope" style="color: #fbb421;"></i> <a class="themecolor careerlink" href="mailto:boibangla1679@gmail.com">boibangla1679@gmail.com</a> <br>
                    <i class="fas fa-phone" style="color: #fbb421;"></i> <a class="themecolor" href="tel:+88 01770-915855">+88 01770-915855</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{-- <script src="{{ asset('assets/js/customer/contacts/contact.js') }}"></script> --}}
    <script>
        $(document).ready(function () {

            // Form submission by Ajax
            $("form#contactForm").on("submit",function (e) {
                e.preventDefault();
                var url = "{{route('contactUs')}}";
                $.ajax({
                    type: 'POST',
                    url: url,
                    data : $("#contactForm").serialize(),
                    beforeSend: function() {
                        // setting a timeout
                        $('#contactusSendbtn').attr('disabled', true).text('Sending....');
                    },
                    success: function (response) {
                        console.log(response.status);
                        $('#popupNotification').toggleClass("d-none").text(response.message).delay(5000).fadeOut(function(){
                            $(this).toggleClass('d-none');
                        });
                        $("#contactForm")[0].reset();
                        $('#contactusSendbtn').attr('disabled', false).text('Message Sent');


                    },
                    error: function (errorData) {
                        $('#popupNotification').toggleClass("d-none").text('Something Wrong!').delay(3000).fadeOut(function(){
                            $(this).toggleClass('d-none');
                        $('#contactusSendbtn').attr('disabled', false).text('Send');

                        });
                    },
                });
            });

        });
    </script>
@endsection
