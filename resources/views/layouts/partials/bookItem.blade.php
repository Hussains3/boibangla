<div class="gridchild">
    <a href="{{ route('getBookDetail', $book->book_slug) }}">
        <div class="homepagebk">
            <span class="cover">
                <img data-src="{{ asset('storage/uploads/books/' . $book->book_image) }}"
                    alt="{{ $book->book_name }}" class="owl-lazy backup_book_picture"
                    src="{{ asset('storage/uploads/books/' . $book->book_image) }}" style="opacity: 1;" width="125"
                    height="200">
            </span>
            @if ($book->regular_price > $book->sale_price)
                <span
                    class="discount">{{ round((($book->regular_price - $book->sale_price) / $book->regular_price) * 100) }}<span
                        class="percent-sign">%</span></span>
            @endif
        </div>

        <span class="title" style="overflow-wrap: break-word; font-wight:700;">{{ $book->book_name }}</span>
        {{-- <span class="title" style="overflow-wrap: break-word; font-wight:700;">
            @forelse ($book->author as $author)
                {{ $author->name }}
            @empty
                <a>Unknown</a>
            @endforelse
        </span> --}}
        <span class="price">
            <span class="list-price">৳{{ $book->regular_price }}</span>&nbsp;
            <span class="sale-price">৳{{ $book->sale_price }}</span>
        </span>
    </a>
</div>
