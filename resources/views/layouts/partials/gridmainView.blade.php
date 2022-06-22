<div class="gridmain">
    <a href="{{ route('getBookDetail', $book->book_slug) }}" title="{{ $book->name }}">
        <div class="tobookimagecover"><span class="cover-discount-tag3">{{round(($book->regular_price - $book->sale_price)/$book->regular_price*100)}}<span class="percent-sign">%</span>
            </span><span class="ts-cover"><img
                    src="{{ asset('storage/uploads/books/'.$book->book_image) }}"
                    alt="{{ $book->name }}"
                    class="bklazy backup_book_picture"
                    style="display: block;" width="100px" height="150px"></span></div>
        <span class="ts-price"><span class="ts-list">৳{{ $book->regular_price }}</span><span
                class="ts-sale">৳{{ $book->sale_price }}</span><span
                class="clearfloat">&nbsp;</span></span><span class="ts-title"
            style="overflow-wrap: break-word;">{{ $book->name }}</span><span
            class="ts-author">{{ $book->authors }}</span>
    </a>
</div>
