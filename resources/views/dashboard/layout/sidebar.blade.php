<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{route('dashboard')}}" class="site_title">
                <img src="{{ asset('images/logos/logoBoibangla.png') }}"  width="118px">
                {{-- <span>ShopZEN</span>--}}
            </a>
        </div>
        <div class="clearfix"></div>
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li><a href="{{route('home.index')}}"><i class="fa fa-eye"></i>View Site</a></li>
                    <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i>Dashboard</a></li>
                    <li><a href="{{route('viewCategory')}}"><i class="fa fa-bars"></i>Categories</a></li>
                    <li><a href="{{route('viewSubCategory')}}"><i class="fa fa-bars"></i>Sub Categories</a></li>
                    <li><a href="{{route('viewPublications')}}"><i class="fa fa-bars"></i>Publications</a></li>
                    <li><a href="{{route('viewTags')}}"><i class="fa fa-bars"></i>Tags</a></li>
                    <li><a href="{{route('viewAuthors')}}"><i class="fa fa-user-secret"></i>Authors</a></li>
                    <li><a><i class="fa fa-book"></i> Book <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('viewBooks')}}">Book</a></li>
                            <li><a href="{{route('addBooks')}}">Add Book</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-certificate"></i> Discounts <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('viewDiscounts')}}">Discounts List</a></li>
                        </ul>
                    </li>
                    <li><a href="{{route('viewCountry')}}"><i class="fa fa-location-arrow"></i>Country</a></li>
                    <li><a href="{{route('viewLanguage')}}"><i class="fa fa-location-arrow"></i>Langage</a></li>


                    @role('admin')
                    <li><a href="{{route('roles.index')}}"><i class="fa fa-users"></i>Role</a></li>
                    <li><a href="{{route('permissions.index')}}"><i class="fa fa-users"></i>Permission</a></li>

                    <li><a><i class="fa fa-certificate"></i> Users <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('viewUsers')}}">All user</a></li>
                            <li><a href="{{route('users.admin')}}">Admins</a></li>
                            <li><a href="{{route('users.operator')}}">Employee</a></li>
                            <li><a href="{{route('users.publisher')}}">Publisher</a></li>
                            <li><a href="{{route('users.affiliator')}}">Affiliator</a></li>
                            <li><a href="{{route('users.customer')}}">Customer</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-bars"></i> Affiliation <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('affiliationapplication.index')}}">Applications</a></li>
                        </ul>
                    </li>
                    @endrole

                    <li><a href="{{route('viewQueries')}}"><i class="fa fa-comment"></i>Queries</a></li>
                    <li><a href="{{route('bookRequests.index')}}"><i class="fa fa-book"></i>Book Request</a></li>
                    <li><a href="{{route('quotes.index')}}"><i class="fa fa-book"></i>Quote</a></li>

                    <li><a><i class="fa fa-first-order"></i> Order <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('viewOrders')}}">Orders</a></li>
                            <li><a href="{{route('viewOrdersBydate')}}">By date</a></li>
                        </ul>
                    </li>

                    <li>
                        <a><i class="fa fa-envelope-o"></i> Newsletters <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('viewSubscribers') }}">Subscribers</a></li>
                            <li><a href="{{ route('ViewComposeNewsletter') }}">Compose</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-image"></i> Media <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('viewBannerImages')}}">Banner Images</a></li>
                            <li><a href="{{route('viewOtherMedia')}}">Other Images</a></li>
                        </ul>
                    </li>
                    <li><a href="{{route('viewSetting')}}"><i class="fa fa-wrench"></i>Settings</a></li>
                    {{-- <li><a href="{{route('viewPopup')}}"><i class="fa fa-check"></i>Poup</a></li>
                    <li><a href="{{route('viewStories')}}"><i class="fa fa-bars"></i>Story</a></li> --}}
                </ul>
            </div>
        </div>
        <div class="sidebar-footer hidden-small" style="display:none;">
            <a data-toggle="tooltip" data-placement="top" title="Settings" href="setting">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="dashboard/logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
    </div>
</div>


