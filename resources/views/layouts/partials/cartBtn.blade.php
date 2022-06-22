<button class="btn-red" type="button"
onclick="addToCart(this);" data-book-id="{{$book->id}}" data-book-name="{{$book->book_name}}" data-book-price="{{($book->sale_price?$book->sale_price:$book->regular_price)}}" data-book-qty="1" data-book-image="{{$book->book_image}}">
Buy Now
</button>


