<div class="headerfixed">
    <div class="headerw100">
        @php
            $cartCollection = \Cart::getContent();
        @endphp
        <div id="header" class="header-default">
            <div class="toggle-menu"><a onclick="$('.navigation-bar').slideToggle();" href="javascript:void(0);">Main
                    Menu</a></div>
            <div class="logo">
                <a href="/">
                    <img src="{{ asset('images/logos/logoBoibangla.png') }}" id="ctl00_imglogo"
                        alt="Boi Bangla online bookstore" width="118px">
                </a>
            </div>
            <div id="ctl00_TopSearch1_plnTopSearch">
                <div class="search-box">
                    <div class="search-input">
                        <form action="" method="post" id="sitebooksearchform">
                            <input name="ctl00$TopSearch1$txtSearch" type="text" id="bookSearch" autocomplete="off"
                                placeholder="বইয়ের নাম, লেখক, প্রকাশনী, ক্যাটাগরি">
                            <div id="divLoader" style="display: none">
                                <div class="lds-spinner">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="search-dropdown">
                        <ul id="resultsBooks">
                        </ul>
                    </div>
                    <div class="search-btn">
                        <input type="submit" name="ctl00$TopSearch1$Button1" value=""
                            onclick="return checkSearchText();" id="ctl00_TopSearch1_Button1" class="sprite search-btn">
                    </div>
                    <div class="clearfloat">
                    </div>
                </div>
                <input type="hidden" name="ctl00$TopSearch1$hdnSearch" id="ctl00_TopSearch1_hdnSearch">
            </div>

            @guest
                <div id="topright-menu">
                    <div id="ctl00_divLogin" class="sprite usermenu-bg1 user-menu">
                        <ul>
                            <li>
                                <a href="{{ route('login') }}">Login</a>
                            </li>
                            <li><a href="{{ route('register.show') }}">Signup</a> </li>
                        </ul>
                    </div>
                    <div class="mini-cart">
                        <div>
                            <div id="myCart" class="cart-pop iframe cart-link sprite cart-linkbg cboxElement"></div>

                            <span class="cart-item-count">
                                <label id="headerCartCount">0</label>
                            </span>
                            </a>
                        </div>
                        <div id="ctl00_divShoppingPopup" class="tooltip"></div>
                    </div>
                    <div class="clearfloat">
                    </div>
                </div>
            @endguest

            {{--  --}}

            @auth
                <div id="topright-menu">
                    <div id="ctl00_divLogged" class="user-menu1">
                        <ul>
                            <li class="cutom-drpdown">
                                <a class="cart-pop1" href="#"><span class="login-bg sprite usermenu-bg">
                                        <span id="ctl00_lblUser">{{ Auth::user()->name }}</span></span></a>
                                <div class="tooltip" style="display: none;">
                                    <div class="tooltip-mid1">
                                        <div class="user-submenu">
                                            <ul>
                                                <li><a href="{{ route('myaccount') }}">My Account</a></li>
                                                @role('admin')
                                                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                                @endrole
                                                @role('publisher')
                                                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                                @endrole
                                                @role('operator')
                                                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                                @endrole
                                                <li>
                                                    <a id="ctl00_lnkbtnLogout" href="{{ route('logout.perform') }}">Log
                                                        out</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="clearfloat">
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="mini-cart">
                        <div>
                            <div id="myCart" class="myCart cart-pop iframe cart-link sprite cart-linkbg cboxElement">
                                <span class="cart-item-count">
                                    <label id="headerCartCount">0</label>
                                </span>
                            </div>
                        </div>
                        <div id="ctl00_divShoppingPopup" class="tooltip"></div>
                    </div>
                    <div class="clearfloat">
                    </div>
                </div>
            @endauth



            <div class="mobile-design">
                <a href="{{ route('myaccount') }}" class="user-info">User Info</a>

                <div class="myCart mobilecart" id="myCart" onclick="cartmodal()" >
                    <img src="{{ asset('cart.png') }}" alt="">
                    <span class="pqty">
                        <label id="mobileheaderCartCount">0</label>
                    </span>
                </div>
                {{-- <a href="" class="my-cart" id="my-cart">Cart</a> --}}
            </div>
            <div class="clearfloat">
            </div>
        </div>
    </div>




    <!-- main navigation div start -->
    <div class="navw100">
        @php
            $categories = \App\Models\Category::all();
            $publications = \App\Models\Publication::all();
        @endphp
        <div id="main-navigation">
            <div class="navigation-bar">
                <a class="close-nav" onclick="$('.navigation-bar').slideToggle();" href="javascript:void(0);"></a>
                <ul class="main-menu">
                    <li id="ctl00_lihome" class="active">
                        <a class="sprite home-ico toplevel oneline" href="/">
                        </a>
                    </li>
                    <li id="ctl00_licategory" class="cat-a02">
                        <a class="toplevel top-drop hide-c" href="/">বই</a>
                        <a class="toplevel top-drop show-c" onclick="$('.catpop').slideToggle();"
                            href="javascript:void(0);">সব বই</a>
                        <div class="popbox catpop three-col">
                            <ul style="width: 100%; display:flex; flex-wrap:wrap;">
                                @forelse ($categories as $category)
                                    <li style="width: 30%;"><a
                                            href="{{ route('showCategory', $category->category_slug) }}">{{ $category->category }}</a>
                                    </li>
                                @empty
                                    <li><a href="#">কোন ক্যাটেগরির বই নেই।</a></li>
                                @endforelse
                            </ul>
                        </div>
                    </li>
                    <li id="ctl00_linewrelease" class="cat-a03"><a class="toplevel oneline"
                            href="{{ route('showCategory', 'new-collection') }}">নতুন কালেকশন</a>
                    </li>
                    <li id="ctl00_lipreorder" class="cat-a04"><a class="toplevel"
                            href="{{ route('showCategory', 'pre-order') }}">প্রি-অর্ডার</a> </li>
                    <li id="ctl00_libestseller" class="cat-a05"><a class="toplevel"
                            href="{{ route('showCategory', 'best-seller') }}">বেস্টসেলার</a> </li>
                    <li id="ctl00_liTextBook" class="cat-a06"><a class="toplevel oneline"
                            href="{{ route('showCategory', 'academic-book') }}">একাডেমিক বই</a>
                    </li>
                    <li id="ctl00_liAW" class="cat-a07"><a class="toplevel oneline"
                            href="{{ route('showCategory', 'award-wining') }}">পুরষ্কারজয়ী বই</a>
                    </li>
                    <li id="ctl00_liAW" class="cat-a07"><a class="toplevel oneline"
                            href="{{ route('showCategory', 'islamic-book') }}">ইসলামিক বই</a>
                    </li>
                    <li id="ctl00_liRequestBook" class="cat-a07"><a class="toplevel oneline"
                            href="{{ route('cfeaturedAuthors') }}">লেখক</a>
                    </li>
                    <li id="ctl00_lipublication" class="cat-a02">
                        <a class="toplevel top-drop hide-c" href="/">প্রকাশনী</a>
                        <a class="toplevel top-drop show-c" onclick="$('.ff').slideToggle();"
                            href="javascript:void(0);">প্রকাশনী</a>
                        <div class="popbox ff three-col">
                            <ul>
                                @forelse ($publications as $publication)
                                    <li><a
                                            href="{{ route('cPublicationBooks', $publication->slug) }}">{{ $publication->name }}</a>
                                    </li>
                                @empty
                                    <li>কোন প্রকাশনী নেই।</li>
                                @endforelse
                            </ul>
                        </div>
                    </li>
                    <li id="ctl00_liRequestBook" class="cat-a07"><a class="toplevel oneline"
                            href="{{ route('get-quote') }}">প্রাতিষ্ঠানিক অর্ডার</a>
                    </li>
                </ul>
            </div>
            <div class="clearfloat">
            </div>
        </div>
    </div>


    <script>
        function cartmodal() {
            let modal = document.getElementById("myModal");
            modal.style.display = "block";
            console.log(modal);
        }
    </script>




</div>
