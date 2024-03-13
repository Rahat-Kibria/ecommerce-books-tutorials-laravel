<div class="site-mobile-menu">
    <header class="mobile-header d-block d-lg-none pt--10 pb-md--10">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <ul class="header-top-list">
                        <li class="dropdown-trigger language-dropdown"><a href="{{ url('') }}"><span
                                    class="flag-img"><img src="{{ url('/frontend/image/icon/eng-flag.png') }}"
                                        alt="American Flag"></span>English </a><i
                                class="fas fa-chevron-down dropdown-arrow"></i>
                            <ul class="dropdown-box">
                                <li> <a href="{{ url('') }}"> <span class="flag-img"><img
                                                src="{{ url('/frontend/image/icon/eng-flag.png') }}"
                                                alt="US Flag"></span>English</a></li>
                                <li> <a href="{{ url('') }}"> <span class="flag-img"><img
                                                src="{{ url('/frontend/image/icon/bd-flag.png') }}"
                                                alt="BD Flag"></span>Bangla</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="col-6 d-flex justify-content-center">
                    <ul class="header-top-list">
                        <li>
                            <a href="{{ route('botu.order.track') }}"><i class="fa fa-truck" aria-hidden="true"></i>
                                Track
                                Order</a>
                        </li>
                    </ul>
                </div>
                <div class="col-3 flex-right">
                    <ul class="header-top-list">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-user-secret"
                                    aria-hidden="true"></i>
                                Admin</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row align-items-sm-end align-items-center">
                <div class="col-md-3 col-6">
                    <a href="index.html" class="site-brand">
                        <img src="{{ url('/frontend/image/books-tutorials-logo.png') }}"
                            style="width: 181px; height:39px" alt="My Website Logo">
                    </a>
                </div>
                <div class="col-md-5 order-3 order-md-2">
                    <nav class="category-nav">
                        <div>
                            <a href="javascript:void(0)" class="category-trigger"><i class="fa fa-bars"></i>Browse
                                categories</a>
                            <ul class="category-menu">
                                @foreach ($rootCategories as $rootCategory)
                                    {{-- @dd($rootCategory->name) --}}
                                    <li class="cat-item-mobile @if ($rootCategory->children->isNotEmpty()) has-children @endif">
                                        <a
                                            href="{{ route('botu.products.list', [$rootCategory->id, $rootCategory->slug]) }}">{{ $rootCategory->name }}</a>
                                        @if ($rootCategory->children->isNotEmpty())
                                            <ul class="sub-menu">
                                                @foreach ($rootCategory->children as $child)
                                                    <li
                                                        class="cat-item-mobile @if ($child->children->isNotEmpty()) has-children @endif">
                                                        <a
                                                            href="{{ route('botu.products.list', [$child->id, $child->slug]) }}">{{ $child->name }}</a>
                                                        @if ($child->children->isNotEmpty())
                                                            <ul class="sub-menu">
                                                                @foreach ($child->children as $ch)
                                                                    <li class="cat-item-mobile">
                                                                        <a
                                                                            href="{{ route('botu.products.list', [$ch->id, $ch->slug]) }}">{{ $ch->name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-md-4 col-6  order-md-3 text-right">
                    <div class="mobile-header-btns header-top-widget">
                        <ul class="header-links">
                            @auth
                                <div class="dropdown_mobile sin-link"><a href="#" onclick="dropdown_toggle()"
                                        class="dropdown_toggle"><i
                                            class="icons-left fas fa-user"></i>{{ auth()->user()->first_name }}</a>
                                    <div class="dropdown_menu" id="dropdown_menu">
                                        <a href="{{ route('botu.account.dashboard') }}">Manage
                                            My Account</a>
                                        <a href="{{ route('botu.account.my_orders') }}">My
                                            Orders</a>
                                        <a href="{{ route('botu.account.wishlist') }}">My
                                            Wishlist</a>
                                        <a href="{{ route('botu.cart') }}">My
                                            Cart</a>
                                        <a href="{{ route('botu.account.my_courses') }}">My
                                            Courses</a>
                                        <a href="{{ route('botu.account.my_audio_books') }}">My
                                            Audio Books</a>
                                        <a href="{{ route('botu.account.my_ebooks') }}">My
                                            Ebooks</a>
                                        <a href="{{ route('botu.account.my_returns') }}">My
                                            Returns</a>
                                        <a href="{{ route('botu.account.my_reviews_history') }}">My
                                            Reviews
                                            Ratings</a>
                                        <a href="{{ route('botu.logout') }}">Logout</a>
                                    </div>
                                </div>
                            @else
                                <li class="sin-link" style="font-size: 0.8rem">
                                    <button type="button" class="font-weight-bold" data-toggle="modal"
                                        data-target="#loginModal">Login</button>
                                    <br>
                                    <span class="mr-1">or</span><button type="button" class="font-weight-bold"
                                        data-toggle="modal" data-target="#registrationModal">Register</button>
                                </li>
                            @endauth
                            <li class="sin-link">
                                <a href="{{ route('botu.cart') }}" class="cart-link link-icon"><i
                                        class="ion-bag"></i></a>
                            </li>
                            <li class="sin-link">
                                <a href="javascript:void(0)" class="link-icon hamburgur-icon off-canvas-btn"><i
                                        class="ion-navicon"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    {{-- Off Canvas Navigation Start --}}
    <aside class="off-canvas-wrapper">
        <div class="btn-close-off-canvas">
            <i class="ion-android-close"></i>
        </div>
        <div class="off-canvas-inner">
            {{-- search box start --}}
            <div class="search-box offcanvas">
                <form action="{{ route('botu.search.products') }}" method="GET" autocomplete="off">
                    <input type="text" name="search_key" id="search_input_mobile"
                        placeholder="Search by name or author">
                    <button type="submit" class="search-btn"><i class="ion-ios-search-strong"></i></button>
                    <div id="product-list-search-mobile" class="row">
                    </div>
                </form>
            </div>
            {{-- search box end --}}
            {{-- mobile menu start --}}
            <div class="mobile-navigation">
                {{-- mobile menu navigation start --}}
                <nav class="off-canvas-nav">
                    <ul class="mobile-menu main-mobile-menu">
                        {{-- Books --}}
                        <li class="menu-item-has-children">
                            <a href="#">Books</a>
                            <ul class="sub-menu">
                                @foreach ($rootCategories as $rootCategory)
                                    {{-- @dd($rootCategory->children[0]->name) --}}
                                    <li class="menu-item-has-children">
                                        <a
                                            href="{{ route('botu.products.list.books', [$rootCategory->id, $rootCategory->slug]) }}">{{ $rootCategory->name }}</a>
                                        @if ($rootCategory->children->isNotEmpty())
                                            <ul class="sub-menu">
                                                @foreach ($rootCategory->children as $child)
                                                    <li class="menu-item-has-children">
                                                        <a
                                                            href="{{ route('botu.products.list.books', [$child->id, $child->slug]) }}">{{ $child->name }}</a>
                                                        @if ($child->children->isNotEmpty())
                                                            <ul class="sub-menu">
                                                                @foreach ($child->children as $ch)
                                                                    <li>
                                                                        <a
                                                                            href="{{ route('botu.products.list.books', [$ch->id, $ch->slug]) }}">{{ $ch->name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        {{-- Tutorials --}}
                        <li class="menu-item-has-children">
                            <a href="#">Tutorials</a>
                            <ul class="sub-menu">
                                @foreach ($rootCategories as $rootCategory)
                                    {{-- @dd($rootCategory->children[0]->name) --}}
                                    <li class="menu-item-has-children">
                                        <a
                                            href="{{ route('botu.products.list.tutorials', [$rootCategory->id, $rootCategory->slug]) }}">{{ $rootCategory->name }}</a>
                                        @if (!empty($rootCategory->children))
                                            <ul class="sub-menu">
                                                @foreach ($rootCategory->children as $child)
                                                    <li class="menu-item-has-children">
                                                        <a
                                                            href="{{ route('botu.products.list.tutorials', [$child->id, $child->slug]) }}">{{ $child->name }}</a>
                                                        @if (!empty($child->children))
                                                            <ul class="sub-menu">
                                                                @foreach ($child->children as $ch)
                                                                    <li>
                                                                        <a
                                                                            href="{{ route('botu.products.list.tutorials', [$ch->id, $ch->slug]) }}">{{ $ch->name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        {{-- Blog --}}
                        <li><a href="{{ route('botu.blog.home') }}">Blog</a></li>
                        {{-- Contact --}}
                        <li><a href="{{ route('botu.contact') }}">Contact</a></li>
                    </ul>
                </nav>
                {{-- mobile menu navigation end --}}
            </div>
            <div class="off-canvas-bottom">
                <div class="contact-list mb--10">
                    <a href="javascript:void(0)" class="sin-contact"><i class="fas fa-mobile-alt"></i>+880
                        12345-67890</a>
                    <a href="javascript:void(0)" class="sin-contact"><i
                            class="fas fa-envelope"></i>suport@botu.com</a>
                </div>
                <div class="off-canvas-social">
                    <a href="#" class="single-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="single-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="single-icon"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </aside>
    {{-- Off Canvas Navigation End --}}
</div>
{{-- Registration Modal Start --}}
@include('auth.registration_modal')
{{-- Registration Modal End --}}
{{-- Login Modal Start --}}
@include('auth.login_modal')
{{-- Login Modal End --}}
