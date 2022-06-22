@extends('profile.dashboard-master')


@section('dashboard-wraper')
    <div id="ps" class="ac-content">
        <div class="title">
            <label id="ctl00_phBody_lblheading">My Wishlist</label>
        </div>
        <div class="wish-wrapper">
            <div id="deald-tab1">
                <div class="clearfloat">
                </div>
                <div class="wish-itm" style="border:none;">
                    <div id="book">



                        {{-- Wishlist Item --}}
                        @forelse ($wishlists as $wishlist)
                            <div class="list-view-books">
                                <div class="serialno">{{ $loop->index+1 }}</div>
                                <div class="cover">
                                    <a href="{{ route('getBookDetail', $wishlist->book->book_slug) }}"><img
                                            src="{{ asset('storage/uploads/books/' . $wishlist->book->book_image) }}" data-src=""
                                            alt="Things That Can and Cannot be Said" class="bklazy backup_book_picture" width="100" height="150">
                                    </a>
                                    <span class="cover-discount-tag">
                                        35
                                        <span class="percent-sign">%</span>
                                    </span>
                                </div>
                                <div class="product-summary">
                                    <div class="title">
                                        <a href="{{ route('getBookDetail', $wishlist->book->book_slug) }}">{{ $wishlist->book->book_name }}</a>
                                    </div>
                                    <div class="author-publisher">
                                        By:
                                        <a href="">Arundhati Roy</a>
                                    </div>
                                    <div class="author-publisher">Publisher: <a
                                            href="">Juggernaut Publication</a> </div>
                                    <div class="price-attrib d-flex">
                                        <div class="price">
                                            <div class="list">৳250</div>
                                            <div class="sell">৳163</div>
                                        </div>
                                        <div class="">
                                            <div class="action-btns d-flex">
                                                <button
                                                    class="btn-red"
                                                    type="button"
                                                    onclick="addToCart(this);"
                                                    data-book-id="{{$wishlist->book->id}}"
                                                    data-book-name="{{$wishlist->book->book_name}}"
                                                    data-book-price="{{($wishlist->book->sale_price?$wishlist->book->sale_price:$wishlist->book->regular_price)}}"
                                                    data-book-qty="1"
                                                    data-book-image="{{$wishlist->book->book_image}}"
                                                >
                                                Buy Now
                                                </button>
                                                <form action="{{route('wishlists.destroy', $wishlist->id)}}" method="POST" id="removefromwishlistform">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" id="remove-from-wishlist" class="btn-black"> Remove from Wishlist</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="action">
                                    <div class="available-stock">Available</div>
                                    <div class="order-info">Ships within <span>5-7 Business Days</span> <a rel="nofollow" class="wws-detail cboxElement"
                                            href="https://www.bookswagon.com/shippingpopup.aspx">Explain..</a></div>
                                    <div class="shipping-info">৳50 shipping in Bangladesh</div>
                                    <div class="action-btns"></div>

                                </div>
                                <div class="clearfloat"></div>
                                <div class="description"></div>
                            </div>
                        @empty
                            <p>No Result Found</p>
                        @endforelse

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>



    </script>
@endsection
