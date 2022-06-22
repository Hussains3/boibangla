@extends('layouts.master')

@section('content')

    <div class="myaccount-form" id="client-form">
        <p style="color:#bc3232;padding: 10px 8px;background-color: #d7f2ef;" class="d-none" id="popupNotification"></p>
        <h2>
            <label id="ctl00_phBody_ShippingAddress_lblheading">Request a Book</label>
        </h2>


        <form  id="bookRequestForm">
            @csrf
            <div class="customer-form">
                <div class="name-fild mandatory">
                    Name:
                </div>
                <div class="input-fild">
                    <input name="name" type="text" maxlength="50" id="name" style=" cursor: auto;"
                        autocomplete="off" required>

                    <br>
                </div>
                <div class="clearfloat">
                </div>
            </div>
            <div class="customer-form">
                <div class="name-fild mandatory">
                    Phone:
                </div>
                <div class="input-fild">
                    <input name="phone" type="text" maxlength="50" id="phone" style=" cursor: auto;"
                        autocomplete="off" required>

                    <br>
                </div>
                <div class="clearfloat">
                </div>
            </div>
            <div class="customer-form">
                <div class="name-fild mandatory">
                    Email:
                </div>
                <div class="input-fild">
                    <input name="email" type="email" maxlength="50" id="email" style=" cursor: auto;"
                        autocomplete="off" required>

                    <br>
                </div>
                <div class="clearfloat">
                </div>
            </div>
            <div class="customer-form">
                <div class="name-fild mandatory">
                    Book Name:
                </div>
                <div class="input-fild">
                    <input name="book_name" type="text" maxlength="50" id="book_name" style=" cursor: auto;"
                        autocomplete="off" required>

                    <br>
                </div>
                <div class="clearfloat">
                </div>
            </div>
            <div class="customer-form">
                <div class="name-fild mandatory">
                    Writer/Publisher Name:
                </div>
                <div class="input-fild">
                    <input name="writer_publisher_name" type="text" maxlength="50" id="writer_publisher_name" style=" cursor: auto;"
                        autocomplete="off" required>

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
        $("form#bookRequestForm").on("submit",function (e) {
            e.preventDefault();
            var name = $('#name').val();
            var phone = $('#phone').val();
            var email = $('#email').val();
            var book_name = $('#book_name').val();
            var writer_publisher_name = $('#writer_publisher_name').val();
            var url = '{{route('bookRequests.store')}}';
            $.ajax({
                type: "POST",
                url: url,
                data: {name:name,phone:phone,email:email,book_name:book_name, writer_publisher_name:writer_publisher_name},
                success: function (response) {
                    if (response.status == "success"){
                        $('#popupNotification').toggleClass("d-none").html('Book requested successfully').delay(3000).fadeOut(function(){
                            $(this).toggleClass('d-none');
                        });
                        $("form#bookRequestForm").each(function () {
                            this.reset();
                        });
                    }
                },
                error:function (errorResponse) {
                    // printErrorMessage(errorResponse);
                    $('#popupNotification').toggleClass("d-none").html('Something Wrong!').delay(3000).fadeOut(function(){
                        $(this).toggleClass('d-none');
                    });
                }
            });
        });

    });
</script>

@endsection
