@extends('layouts.master')

@section('content')
    <section id="corporate-header">
        <div class="container">
            <div class="row">

                <div class="">
                    <h1>
                        বইবাঙলা-এর কর্পোরেট কাস্টমাররা পাচ্ছেন কাস্টমাইজড সার্ভিস
                    </h1>

                    <p id="">
                        টেন্ডার, RFQ অথবা সরাসরি ক্রয় যেভাবেই কেনা হোক, যত কপি-ই অর্ডার করা হোক না কেনো বাংলাদেশের যেকোন স্থানে বই পৌছে দিচ্ছি আমরা। স্কুল, কলেজ, বিশ্ববিদ্যালয়, লাইব্রেরি, কর্পোরেট হাউজ, ব্যাংক, বীমা, NGO, ডিফেন্স, সরকারি, বেসরকারি, আধা-সরকারি ও ধর্মীয় প্রতিষ্টানসহ সব ধরনের প্রতিষ্টানে সর্বোচ্চ ছাড়ে দেশি-বিদেশি অরিজিনাল প্রিন্টেড বই সরবরাহ করে থাকে বই বাঙলা কর্পোরেট টীম।
                    </p>

                    <a href="#client-form" class="btn-red" id="corporate-jump">Request A Quote</a>

                    <p id="r">
                        <i>&nbsp; &nbsp; OR</i>&nbsp; &nbsp;
                        +8801977011637, +8801770915855 (9AM – 7PM)
                    </p>

                </div>
            </div>
        </div>
    </section>

    <section id="corporate-features">
        <div class="container">
            <div class="row">

                <h2 class="corporate_h1 text-center">Why choose us</h2>
                <div class="d-flex justify-content-between">
                    <div class="col-md-4 col-sm-4 col-xs-12 text-center why-choose-us">
                        <div class="img-border center-block">
                            <div class="img-wrapper">
                                <img alt="Largest Book Collection" src="{{asset('images/icons/corporate_book.png')}}">
                            </div>
                        </div>
                        <h1>Largest Book Collection</h1>
                        <p>
                            "Reading book is a wonderful experience and there's an explorer in all of us who shouldn't be
                            lost at any cost.
                            We offer splendid discounts on bulk purchases."
                        </p>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12 text-center why-choose-us">
                        <div class="img-border center-block">
                            <div class="img-wrapper">
                                <img alt="Largest Book Collection" src="{{asset('images/icons/corporate_tag.png')}}">
                            </div>
                        </div>
                        <h1>Best Price</h1>
                        <p>
                            "Reading book is a wonderful experience and there's an explorer in all of us who shouldn't be
                            lost at any cost.
                            We offer splendid discounts on bulk purchases."
                        </p>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12 text-center why-choose-us">
                        <div class="img-border center-block">
                            <div class="img-wrapper">
                                <img alt="Largest Book Collection" src="{{asset('images/icons/corporate_delivery.png')}}">
                            </div>
                        </div>
                        <h1>On Time Delivery</h1>
                        <p>
                            On Time 24/7 Delivery is available to meet your unique on-demand and scheduled delivery needs.
                            Our professional executives
                            and friendly customer service will ensure your books are delivered reliability to their
                            destination
                            and it will be free of cost.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <div class="myaccount-form" id="client-form">
        <p style="color:#bc3232;padding: 10px 8px;background-color: #d7f2ef;" class="d-none" id="popupNotification"></p>

        <h2>
            <label id="ctl00_phBody_ShippingAddress_lblheading">Request a Quote</label>
        </h2>


        <form action="{{ route('quotes.store') }}" method="post" enctype="multipart/form-data" id="quoteform">
            @csrf
            <div class="customer-form">
                <div class="name-fild mandatory">
                    Name:
                </div>
                <div class="input-fild">
                    <input name="name" type="text" maxlength="50" id="RecipientName" style=" cursor: auto;"
                        autocomplete="off">

                    <br>
                </div>
                <div class="clearfloat">
                </div>
            </div>
            <div class="customer-form">
                <div class="name-fild mandatory">
                    Organzation's Name:
                </div>
                <div class="input-fild">
                    <input name="organization_name" type="text" maxlength="50" id="CompanyName" style=" cursor: auto;"
                        autocomplete="off">

                </div>
                <div class="clearfloat">
                </div>
            </div>

            <div class="customer-form">
                <div class="name-fild mandatory">
                    Phone:
                </div>
                <div class="input-fild">
                    <input name="phone" type="text" maxlength="11" id="Phone" style="" required>
                </div>
                <div class="clearfloat">
                </div>
            </div>
            <div class="customer-form">
                <div class="name-fild">
                    Book List:
                </div>
                <div class="input-fild">
                    <input name="book_list" type="file" id="book_list" required>
                </div>
                <div class="clearfloat">
                </div>
            </div>

            <div class="customer-form">
                <div class="name-fild">
                </div>
                <div class="input-fild">
                    <button class="btn-red" type="reset">Reset</button>
                    <button class="btn-red" type="submit">Submit</button>
                </div>
            </div>

        </form>
    </div>
@endsection



@section('script')
<script>
        $(document).ready(function () {

            // Form submission by Ajax
            // $("form#quoteform").on("submit",function (e) {
            //     e.preventDefault();
            //     var url = '{{ route('quotes.store') }}';
            //     $.ajax({
            //         type: "POST",
            //         url: url,
            //         data: $("#quoteform").serialize(),
            //         success: function (response) {
            //             if (response.status == "success"){
            //                 $('#popupNotification').toggleClass("d-none").html(response.message).delay(3000).fadeOut(function(){
            //                     $(this).toggleClass('d-none');
            //                 });
            //                 $("form#quoteform").each(function () {
            //                     this.reset();
            //                 });
            //             }
            //         },
            //         error:function (errorResponse) {
            //             $('#popupNotification').toggleClass("d-none").html('Something Wrong!').delay(3000).fadeOut(function(){
            //                 $(this).toggleClass('d-none');
            //             });
            //         }
            //     });
            // });

        });
</script>
@endsection
