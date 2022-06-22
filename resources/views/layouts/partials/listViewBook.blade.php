<div class="list-view-books">
    <div class="serialno">{{ $loop->index+1 }}</div>
    <div class="cover">
        <a href="{{ route('getBookDetail', $book->book_slug) }}"><img
                src="{{ asset('storage/uploads/books/' . $book->book_image) }}" data-src=""
                alt="Things That Can and Cannot be Said" class="bklazy backup_book_picture" width="100" height="150">
        </a>
        <span class="cover-discount-tag">
            35
            <span class="percent-sign">%</span>
        </span>
    </div>
    <div class="product-summary">
        <div class="title">
            <a href="{{ route('getBookDetail', $book->book_slug) }}">{{ $book->book_name }}</a>
        </div>
        <div class="author-publisher">
            By:
            <a href="">Arundhati Roy</a>
        </div>
        <div class="author-publisher">Publisher: <a
                href="">Juggernaut Publication</a> </div>
        <div class="price-attrib">
            <div class="price">
                <div class="list">৳250</div>
                <div class="sell">৳163</div>
            </div>
            <div class="right-border"></div>
            <div class="attributes">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                        <tr>
                            <td valign="top">
                                <div class="attributes-head">Binding:</div>
                            </td>
                            <td valign="top">
                                <div class="attributes-title">Paperback</div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <div class="attributes-head">Release:</div>
                            </td>
                            <td valign="top">
                                <div class="attributes-title">30 Jun 2016</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="clearfloat"></div>
            </div>
            <div class="clearfloat"></div>
        </div>
    </div>
    <div class="action">
        <div class="available-stock">Available</div>
        <div class="order-info">Ships within <span>5-7 Business Days</span> <a rel="nofollow" class="wws-detail cboxElement"
                href="https://www.bookswagon.com/shippingpopup.aspx">Explain..</a></div>
        <div class="shipping-info">৳50 shipping in Bangladesh</div>
        <div class="action-btns"></div>
        <div class="action-btns d-flex">
            @include('layouts.partials.cartBtn')
            <form action="{{route('wishlists.store')}}" method="post" id="addtowishlistform">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <button type="submit" id="add-to-wishlist" class="btn-black"> Add to Wishlist</button>
            </form>
        </div>
    </div>
    <div class="clearfloat"></div>
    <div class="description"></div>
</div>
