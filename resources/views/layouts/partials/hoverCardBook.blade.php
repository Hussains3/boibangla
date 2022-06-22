<li>
    <div class="persona hovercard">
        <div class="grid-cont"><a href="{{ route('getBookDetail', $book->book_slug) }}"
                title="{{ $book->book_name }}"><span class="cover"><img
                        src="{{ asset('storage/uploads/books/' . $book->book_image) }}" alt="{{ $book->book_name }}"
                        class="bklazy backup_book_picture" style="display: block;" width="125px"
                        height="200px"></span><span class="price"><span
                        class="sale-price">৳{{ $book->sale_price }}</span></span><span class="title"
                    style="overflow-wrap: break-word;">{{ $book->book_name }}</span></a></div>
        {{-- <div class="description">
            <div class="available-stock">
                <div class="available-stock">{{ $book->edition }}</div>
            </div>
            <div class="form-rel"><span>Binding: Paperback</span><span>Release: 19 Dec 2014</span><span>Language:
                    German</span></div>
            <div class="action"><span class="podnr-grd"><img
                        src="https://www.bookswagon.com/images/buttons/pod3.png"></span></div>
            <div class="action">
                <span>
                    @include('layouts.partials.cartBtn')
                </span>
                <span><a href="https://www.bookswagon.com/wishlist.aspx?pid=15277805" rel="nofollow"
                        onclick="javascript: fbq('track', 'AddToWishlist');">Add to Wishlist</a></span>
            </div>
        </div> --}}
    </div>
</li>
