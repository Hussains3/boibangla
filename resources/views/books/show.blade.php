@extends('layouts.master')

@section('content')
    <!-- Information div for search result page -->
    <div class="product-detail">
        <div class="summary">
            <div class="cover">
                <div class="ektu-porun">একটু পড়ে দেখুন <span class="down-arrow">↴</span></div>
                <div class="cover-img" id="cover-img">
                    <img src="{{ asset('storage/uploads/books/' . $bookDetail->book_image) }}"
                        data-image="{{ asset('storage/uploads/books/' . $bookDetail->book_image) }}" id=""
                        class="bklazy backup_book_picture" alt="{{ $bookDetail->book_name }}"
                        title="{{ $bookDetail->book_name }}" width="200" height="300">
                </div>
            </div>
            <div class="product-info">
                <div class="title">
                    <h1>
                        <span>
                        </span> <span id="">{{ $bookDetail->book_name }}</span>
                    </h1>
                    @if ($bookDetail->quality)
                        <span class="title-ico">
                            <label id="ctl00_phBody_ProductDetail_lblBinding">({{ $bookDetail->quality }})</label>
                        </span>
                    @endif
                </div>
                <div class="author-publisher">
                    <label id="ctl00_phBody_ProductDetail_lblAuthor1">By:
                        @foreach ($bookDetail->author as $author)
                            <a href="{{ route('cAuthorBooks', $author->slug) }}">{{ $author->name }}</a>
                        @endforeach
                    </label>
                    <label id=""> | Publisher:
                        @forelse ($bookDetail->publication as $publication)
                            <a href="{{ route('cPublicationBooks', $publication->slug) }}">{{ $publication->name }}</a>
                        @empty
                            <a>Unknown</a>
                        @endforelse
                    </label>
                </div>
                <div class="reviews">
                    <div class="rating present-rating">
                        <ul class="d-flex list-unstyled">
                            <li><img src="/images/dynamic/star-red.gif" id="" alt="Red Star"></li>
                            <li><img src="/images/dynamic/star-red.gif" id="" alt="Red Star"></li>
                            <li><img src="/images/dynamic/star-red.gif" id="" alt="Red Star"></li>
                            <li><img src="/images/dynamic/star-red.gif" id="" alt="Red Star"></li>
                            <li><img src="/images/dynamic/star-red.gif" id="" alt="Red Star"></li>
                        </ul>
                    </div>
                    <div class="post">
                        | <a href="#reviewformtoggle">Post a Review</a>
                    </div>
                    <div class="clearfloat">
                    </div>
                </div>
                <div class="book-details">
                    <div class="price">
                        <div class="list">
                        </div>
                        <div class="sale">
                            <label id="ourPrice">৳{{ $bookDetail->sale_price }}</label>
                            <span
                                style="color: #b4b4b4;text-decoration: line-through;">৳{{ $bookDetail->regular_price }}</span>
                        </div>
                    </div>
                    <div class="stock-info">
                        @if ($bookDetail->edition)
                            <div id="ctl00_phBody_ProductDetail_lblAvailable" class="available">
                                {{ $bookDetail->edition ?? 'Unknown' }}</div>
                        @endif
                        <div class="shipping-info">
                            <label id="ctl00_phBody_ProductDetail_lblBusiness">Ships within <b>5-7 Business
                                    Days</b></label>
                            <label id="ctl00_phBody_ProductDetail_lishipping"><br>Shipping in Bangladesh.</label>
                            <div id="divNotifyMsg" class="notifymebox" style="display: none;">We will notify you once
                                this book available in stock.</div>
                        </div>
                    </div>
                    <div class="clearfloat">
                    </div>
                </div>
                <div id="ctl00_phBody_ProductDetail_divaction" class="action">
                    <div id="" class="btn-grp d-flex justify-content-center">
                        <button class="btn-red" type="button" onclick="addToCart(this);"
                            data-book-id="{{ $bookDetail->id }}" data-book-name="{{ $bookDetail->book_name }}"
                            data-book-price="{{ $bookDetail->sale_price ? $bookDetail->sale_price : $bookDetail->regular_price }}"
                            data-book-qty="1" data-book-image="{{ $bookDetail->book_image }}">
                            Buy Now
                        </button>
                        <div>
                            @auth
                                @if ($wishlistsbooks->contains($bookDetail->id))
                                    <form action="{{ route('wishlists.destroy', $mywishlist->id) }}" method="POST"
                                        id="removefromwishlistform">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" id="remove-from-wishlist" class="btn-black">
                                            Remove from Wishlist</button>
                                    </form>
                                @else
                                    <form id="addtowishlistform">
                                        @csrf
                                        <input type="hidden" name="book_id" value="{{ $bookDetail->id }}">
                                        <button type="submit" id="add-to-wishlist" class="btn-black"> Add to
                                            Wishlist</button>
                                    </form>
                                @endif
                            @endauth

                            @guest
                                <form id="addtowishlistform">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $bookDetail->id }}">
                                    <button type="submit" id="add-to-wishlist" class="btn-black"> Add to
                                        Wishlist</button>
                                </form>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfloat">
            </div>
        </div>
        <div class="side-bar">
            <div class="safe-shopping">
                <h2>Safe &amp; Secure Shopping
                </h2>
                <p>
                    <img src="/images/safe-shopping-ico.gif" title="" alt="" align="left">
                    Payment accepted by All Major Credit and Debit cards, lnternet banking, Mobile Banking,
                    Cash-on-Delivery.
                </p>
            </div>
            {{-- <div class="buy-online">
                <img src="/images/buttons/buyonline-ico.gif" title="" alt="">
            </div> --}}
            <div class="delivery-info">
                <ul>
                    <li class="cashdeliverylist">Cash on Delivery
                        Available in Bangladesh at <strong>৳60</strong>(additional)</li>
                </ul>
            </div>
        </div>
        <div class="clearfloat"></div>
    </div>
    <div class="hor-line">
        &nbsp;
    </div>

    <div class="px-1">
        <div class="about-book" id="bookdetail">
            <div class="title"> Book Details </div>
            <div class="book-details">
                <div class="left">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                            @if ($bookDetail->book_name)
                                <tr>
                                    <td>Title: </td>
                                    <td>{{ $bookDetail->book_name ?? '' }}</td>
                                </tr>
                            @endif


                            @if (count($bookDetail->author))
                                <tr>
                                    <td>Autor: </td>

                                    <td>
                                        @forelse ($bookDetail->author as $author)
                                            <a
                                                href="{{ route('cAuthorBooks', $author->slug) }}">{{ $author->name }}</a>
                                        @empty
                                            <a>Unknown</a>
                                        @endforelse
                                    </td>
                                </tr>
                            @endif

                            @if ($bookDetail->editor)
                                <tr>
                                    <td>Editor/Translator: </td>

                                    <td>{{ $bookDetail->editor }}</td>
                                </tr>
                            @endif
                            @if ($bookDetail->edition)
                                <tr>
                                    <td>Edition: </td>
                                    <td>{{ $bookDetail->edition ?? 'Unknown' }}</td>
                                </tr>
                            @endif
                            @if ($bookDetail->isbn)
                                <tr>
                                    <td>ISBN: </td>
                                    <td>{{ $bookDetail->isbn ?? '' }}</td>
                                </tr>
                            @endif

                            @if (count($bookDetail->publication))
                                <tr>
                                    <td>Publisher: </td>
                                    <td>
                                        @forelse ($bookDetail->publication as $publication)
                                            <a href="{{ route('cPublicationBooks', $publication->slug) }}">
                                                {{ $publication->name }}</a>,
                                        @empty
                                            <a>Unknown</a>
                                        @endforelse
                                    </td>
                                </tr>
                            @endif
                            @if ($bookDetail->quality)
                                <tr>
                                    <td>Quality: </td>
                                    <td>{{ $bookDetail->quality ?? 'Unknown' }}</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
                <div class="right">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                            @if ($bookDetail->number_of_pages)
                                <tr>
                                    <td>No of Pages: </td>
                                    <td>{{ $bookDetail->number_of_pages ?? 'Unknown' }}</td>
                                </tr>
                            @endif

                            @if ($bookDetail->languages)
                                <tr>
                                    <td>Language: </td>
                                    <td>
                                        @forelse ($bookDetail->languages as $language)
                                            {{ $language->name }},
                                        @empty
                                            <a>Unknown</a>
                                        @endforelse
                                    </td>
                                </tr>
                            @endif


                            @if ($bookDetail->countries)
                                <tr>
                                    <td>Country: </td>
                                    <td>
                                        @forelse ($bookDetail->countries as $country)
                                            {{ $country->name == 'Bangladesh' ? 'বাংলাদেশ' : $country->name }}
                                        @empty
                                            <a>Unknown</a>
                                        @endforelse
                                    </td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="about-book" id="aboutbook">
            <div class="title">
                Book Summary
                <input type="submit" name="" value="Hide Detail" onclick="return ShowHideDesc();"
                    id="Desc_btnColExp">
            </div>
            <div>
                <span id="LongDesc">
                    {!! $bookDetail->summary ?? 'Summary Not avilable' !!}
                </span>
            </div>
        </div>

        <div class="about-book">
            <div class="title" id="review">User Reviews</div>
            <p style="margin:10px 0 0 0">
                @guest <a href="">Write a Review</a> @endguest
                @auth <button id="reviewformtoggle" class="btn-red-micro pointer">Write a Review</button> @endauth
                on this book
                <strong>{{ $bookDetail->book_name }}</strong>
            </p>
            @auth
                <div class="d-none p-1 mt-1" id="reviewform">
                    <form action="{{route('rateBook.store')}}" method="POST" id="rateBook">
                        @csrf
                        @method('post')
                        <div class="formdiv">
                            <div class="stardiv d-flex">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path id="st1" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path id="st2" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path id="st3" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path id="st4" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path id="st5" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/></svg>
                            </div>
                            <input type="hidden" name="ratinNumber" value="" id="ratinNumber">
                            <input type="hidden" name="book_id" value="{{$bookDetail->id}}" id="ratinNumber">
                            <label for="name" class="d-block w-100">Write Review<span class="themecolor">*</span></label>
                            <textarea name="reviewDescription" rows="4"  id="reviewDescription" class="new-txt-box w-100 mb-1"
                                placeholder="Length should not be more the 8000 characters"></textarea>
                        </div>
                        <div class="reviewsubmitdiv">
                            <input type="submit" name="submitbtn" value="Submit" id="reviewsubmitbtn" class="btn-red-micro">
                        </div>
                    </form>
                </div>
            @endauth

            <div class="existingReviews mt-1">
                @foreach ($reviews as $review)
                    <div class="eachreview p-1">
                        <p><strong>{{$review->name}}</strong></p>
                        <div class="">
                            <ul class="d-flex list-unstyled">
                                @for ($i = 0; $i < $review->rating; $i++)
                                <li><img src="/images/dynamic/star-red.gif" id="" alt="Red Star"></li>
                                @endfor
                            </ul>
                        </div>
                        <p>{{$review->remark}}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>




    <div class="about-book" style="border-bottom:none;">
        <div class="title">Similler Books<span class="view-more"><a
                    href="{{ route('showCategory', $bookCategory->category_slug) }}">View More</a></span></div>
        <div class="top-selling">
            <div class="ts-grid">
                @forelse ($bookCategory->books as $book)
                    @include('layouts.partials.bookItem')
                @empty

                @endforelse
            </div>
        </div>
    </div>

    @include('layouts.partials.readModal')

@endsection


@section('script')
    <script>
        $(document).ready(function() {
            // Form submission by Ajax
            $("form#addtowishlistform").on("submit", function(e) {
                e.preventDefault();
                var url = "{{ route('wishlists.store') }}";
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: $("#addtowishlistform").serialize(),
                    beforeSend: function() {
                        // setting a timeout
                        $('#add-to-wishlist').attr('disabled', true).text('Adding....');
                    },
                    success: function(response) {

                        $('#add-to-wishlist').attr('disabled', true).text('Added');
                        location.reload();
                    },
                    error: function(errorData) {
                        $('#add-to-wishlist').attr('disabled', false).text('Add to Wishlist');
                    },
                });
            });


            // Revoew Star
            $("#st1").click(function (e) {
                e.preventDefault();
                $("#st1").toggleClass("starRed");
                $("#st2, #st3, #st4, #st5").removeClass("starRed");
                setRatingNumber();
            });
            $("#st2").click(function(e) {
                e.preventDefault();
                $("#st2").toggleClass("starRed");
                $("#st1").addClass("starRed");
                $("#st3, #st4, #st5").removeClass("starRed");
                setRatingNumber();

            });
            $("#st3").click(function(e) {
                e.preventDefault();
                $("#st3").toggleClass("starRed");
                $("#st1,#st2").addClass("starRed");
                $("#st4, #st5").removeClass("starRed");
                setRatingNumber();
            });
            $("#st4").click(function(e) {
                e.preventDefault();
                $("#st4").toggleClass("starRed");
                $("#st1,#st2,#st3").addClass("starRed");
                $("#st5").removeClass("starRed");
                setRatingNumber();
            });
            $("#st5").click(function(e) {
                e.preventDefault();
                $("#st5").toggleClass("starRed");
                $("#st1,#st2,#st3,#st4").addClass("starRed");
                setRatingNumber();
            });

            // Update ratinNumber value
            function setRatingNumber () {
                var ratinNumber = $('.starRed').length;
                $("#ratinNumber").val(ratinNumber);
                console.log(ratinNumber);
            }
            // Submit review form
            $("form#rateBook").on("submit", function(e) {
                e.preventDefault();
                var url = "{{ route('rateBook.store') }}";
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: $("form#rateBook").serialize(),
                    beforeSend: function() {
                        $("#reviewform").toggle();
                        $("#Desc_btnColExp").val(function(i, text) {
                            return text === "Show Detail" ? "Hide Detail" : "Show Detail";
                        });
                        console.log('Rated');
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(errorData) {
                        $("#reviewform").show();
                        $("#Desc_btnColExp").val(function(i, text) {
                            return text === "Show Detail" ? "Hide Detail" : "Show Detail";
                        });
                    },
                });
            });




            // Toggle Book Summary
            $("#Desc_btnColExp").click(function(e) {
                e.preventDefault();
                $("#LongDesc").toggle();
                $("#Desc_btnColExp").val(function(i, text) {
                    return text === "Show Detail" ? "Hide Detail" : "Show Detail";
                });
            });


            $("#reviewformtoggle").click(function(e) {
                e.preventDefault();
                $("#reviewform").toggle();
                $("#reviewformtoggle").text(function(i, text) {
                    return text === "Write a Review" ? "Hide Form" : "Write a Review";
                });
            });




        });
    </script>
@endsection
