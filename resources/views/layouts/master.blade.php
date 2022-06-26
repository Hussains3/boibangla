<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('images/logos/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/logos/favicon.ico') }}" type="image/x-icon">

    <title>
        Online Bookstore | Buy Books Online | Read Books Online
    </title>
    {{-- Hind Shiliguri --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anek+Bangla:wght@300;400;500;700&display=swap" rel="stylesheet">
    {{-- Fontawesoe 5 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Owl carousel 2 css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Owl carousel 2 css  end --}}

    <link rel="stylesheet" href="{{ asset('App_Themes/Common/style-v2.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
    <link href="{{ asset('web/assets/toaster/toastr.min.css') }}" rel="stylesheet" />


    <!-- select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />








    @yield('individualcss')

    <script>
        let BASE_URL = {!! json_encode(url('/')) !!} + "/";
    </script>

    @yield('headScript')

</head>

<body class="padtpfix">
    {{-- Facebook Messenger --}}
    @include('layouts.partials.fbmessanger')


    {{-- site wrapper --}}
    <div id="site-wrapper">
        {{-- header --}}
        @include('layouts.partials.header')



        {{-- page content --}}
        @yield('content')


    </div>

    {{-- cart modal --}}
    @include('layouts.partials.cartModal')

    {{-- footer --}}
    @include('layouts.partials.footer')




    <img id="ctl00_Footer_imgCacheClear" height="1" width="1" style="display:none">
    <div class="full-loader" style="display: none">
        <div id="loader"></div>
    </div>
    <!--End of Tawk.to Script-->








    {{-- Jquerry 3.6 --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>




    {{-- Jquerry UI --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
        integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- owl carousel 2 js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/modal.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/admin/books/books.js') }}"></script>

    <script src="{{ asset('assets/js/customer/products/get-reviews-and-ratings.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/customer/products/get-related-products.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/customer/cart/create-update-cart.js') }}" type="text/javascript"></script>
    <script src="{{ asset('web/assets/toaster/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/js/common.js') }}"></script>
    {{-- <script src="{{asset('service-worker.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/js/notifications.js')}}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>


    <!-- yield script-->
    @yield('script')
    <!-- yield script end-->

    <script>
        $(document).ready(function() {
            var demoBook = '{{ URL::asset('images/bookthumbnail.jpg') }}';
            var demoAuthor = '{{ URL::asset('images/author.jpg') }}';
            var demoPublication = '{{ URL::asset('images/publication.jpg') }}';

            // Book Image
            $(".backup_book_picture").on("error", function() {
                $(this).attr('src', demoBook);
            });

            // Author Photo
            $(".backup_author_picture").on("error", function() {
                $(this).attr('src', demoAuthor);
            });

            // Publication
            $(".backup_publication_picture").on("error", function() {
                $(this).attr('src', demoPublication);
            });



        });


        $(window).on('load', function() {
            // $(".books-itm-grid .itm .title").dotdotdot();
            if (window.innerWidth < 750) {
                // var t=0; // the height of the highest element (after the function runs)
                // var t_elem;  // the highest element (after the function runs)
                // $(".books-itm-grid .itm").each(function () {
                //     $this = $(this);
                // if ( $this.outerHeight() > t ) {
                //     t_elem=this;
                //     t=$this.outerHeight();
                // }
                // });

                // $('.book-slide').height('250px');
            }
        });

        function removeWishlist(bookId) {
            console.log('delete' + bookID);
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('form#sitebooksearchform').on('submit', function(e) {
            e.preventDefault();
        });
    </script>
</body>

</html>
