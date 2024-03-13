<div class="site-header header-3  d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
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
            <div class="col-lg-4 d-flex justify-content-lg-center">
                <ul class="header-top-list">
                    <li>
                        <a href="{{ route('botu.order.track') }}"><i class="fa fa-truck" aria-hidden="true"></i> Track
                            Order</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4 flex-lg-right">
                <ul class="header-top-list">
                    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-user-secret" aria-hidden="true"></i>
                            Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="header-middle pt--10 pb--10">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <a href="{{ route('botu') }}" class="site-brand">
                        <img src="{{ url('/frontend/image/books-tutorials-logo.png') }}"
                            style="width: 181px; height:39px" alt="My Website Logo">
                    </a>
                </div>
                <div class="col-lg-5">
                    <div class="header-search-block">
                        <form action="{{ route('botu.search.products') }}" method="GET" autocomplete="off">
                            <input type="text" name="search_key" id="search_input"
                                placeholder="Search by name or author" required>
                            <button type="submit" id="search_submit">Search</button>
                            <div id="product-list-search">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="main-navigation flex-lg-right">
                        <div class="cart-widget">
                            @auth
                                <ul>
                                    <li class="dropdown-trigger language-dropdown"><i class="icons-left fas fa-user"></i>
                                        {{ auth()->user()->first_name }}'s
                                        Account<i class="fas fa-chevron-down dropdown-arrow"></i>
                                        <ul class="dropdown-box">
                                            <li> <a href="{{ route('botu.account.dashboard') }}">Manage My Account</a></li>
                                            <li> <a href="{{ route('botu.account.my_orders') }}">My Orders</a></li>
                                            <li> <a href="{{ route('botu.account.wishlist') }}">My Wishlist</a></li>
                                            <li> <a href="{{ route('botu.cart') }}">My Cart</a></li>
                                            <li> <a href="{{ route('botu.account.my_courses') }}">My Courses</a></li>
                                            <li> <a href="{{ route('botu.account.my_audio_books') }}">My Audio Books</a>
                                            </li>
                                            <li> <a href="{{ route('botu.account.my_ebooks') }}">My Ebooks</a></li>
                                            <li> <a href="{{ route('botu.account.my_returns') }}">My Returns</a></li>
                                            <li> <a href="{{ route('botu.account.my_reviews_history') }}">My Reviews
                                                    Ratings</a></li>
                                            <li> <a href="{{ route('botu.logout') }}">Logout</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            @else
                                <div class="login-block">
                                    <button type="button" class="font-weight-bold" data-toggle="modal"
                                        data-target="#loginModal">Login</button> <br>
                                    <span>or</span><button type="button" class="font-weight-bold" data-toggle="modal"
                                        data-target="#registrationModal">Register</button>
                                </div>
                            @endauth
                            @php
                                if (auth()->check()) {
                                    $cart_items = App\Models\Cart::all()->where('user_id', auth()->user()->id);
                                    $total_cart_item = $cart_items->sum('quantity');
                                    $total_cart_price = $cart_items->sum(function ($total) {
                                        $product_price = $total->product->price - ($total->product->price * $total->product->discount) / 100;
                                        return $product_price * $total->quantity;
                                    });
                                } else {
                                    $cart_items = App\Models\Cart::all()->where('ip_address', request()->ip());
                                    $total_cart_item = $cart_items->sum('quantity');
                                    $total_cart_price = $cart_items->sum(function ($total) {
                                        $product_price = $total->product->price - ($total->product->price * $total->product->discount) / 100;
                                        return $product_price * $total->quantity;
                                    });
                                }
                            @endphp
                            <div class="cart-block">
                                <div class="cart-total">
                                    <span class="text-number">
                                        {{ $total_cart_item }}
                                    </span>
                                    <span class="text-item">
                                        Shopping Cart
                                    </span>
                                    <span class="price">
                                        ৳{{ $total_cart_price }}
                                        <i class="fas fa-chevron-down"></i>
                                    </span>
                                </div>
                                <div class="cart-dropdown-block">
                                    @forelse ($cart_items as $cart_item)
                                        <div class=" single-cart-block ">
                                            <div class="cart-product">
                                                @php
                                                    $cart_image = json_decode($cart_item->product->image);
                                                    $product_price = $cart_item->product->price - ($cart_item->product->price * $cart_item->product->discount) / 100;
                                                @endphp
                                                @if ($cart_item->product->type == 'Book')
                                                    <a href="{{ route('botu.product.details', [$cart_item->product->id, $cart_item->product->slug]) }}"
                                                        class="image">
                                                        <img src="{{ url('/uploads/product_images/' . $cart_image[0]) }}"
                                                            alt="product pic">
                                                    </a>
                                                @else
                                                    <a href="{{ route('botu.tutorial.details', [$cart_item->product->id, $cart_item->product->slug]) }}"
                                                        class="image">
                                                        <img src="{{ url('/uploads/product_images/' . $cart_image[0]) }}"
                                                            alt="product pic">
                                                    </a>
                                                @endif
                                                <div class="content">
                                                    <h3 class="title">
                                                        @if ($cart_item->product->type == 'Book')
                                                            <a
                                                                href="{{ route('botu.product.details', [$cart_item->product->id, $cart_item->product->slug]) }}">{{ $cart_item->product->name }}</a>
                                                        @else
                                                            <a
                                                                href="{{ route('botu.tutorial.details', [$cart_item->product->id, $cart_item->product->slug]) }}">{{ $cart_item->product->name }}</a>
                                                        @endif
                                                    </h3>
                                                    <p class="price"><span class="qty">{{ $cart_item->quantity }}
                                                            ×</span> ৳{{ $product_price }}</p>
                                                    <form action="{{ route('botu.cart.delete', $cart_item->id) }}"
                                                        method="get">
                                                        <button class="cross-btn" type="submit"
                                                            onclick="return confirm('Are you sure?')"><i
                                                                class="fas fa-times"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="single-cart-block text-center">
                                            <p class="alert alert-danger">Sorry no product here</p>
                                        </div>
                                    @endforelse
                                    <div class=" single-cart-block ">
                                        <div class="btn-block">
                                            <a href="{{ route('botu.cart') }}" class="btn">View Cart <i
                                                    class="fas fa-chevron-right"></i></a>
                                            <a href="{{ route('botu.order.checkout.page') }}"
                                                class="btn btn--primary">Checkout <i
                                                    class="fas fa-chevron-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- @include('menu.htm') --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <nav class="category-nav">
                        <div>
                            <a href="javascript:void(0)" class="category-trigger"><i class="fa fa-bars"></i>Browse
                                categories</a>
                            {{-- @foreach ($rootCategories as $rootCategory)
                                @dd($rootCategory->slug, $rootCategory->id)
                                @foreach ($rootCategory->children as $child)
                                    @dd($child)
                                @endforeach
                            @endforeach --}}
                            <ul class="category-menu">
                                @foreach ($rootCategories as $rootCategory)
                                    {{-- @dd($rootCategory->name) --}}
                                    <li class="cat-item @if ($rootCategory->children->isNotEmpty()) has-children @endif">
                                        <a
                                            href="{{ route('botu.products.list', [$rootCategory->id, $rootCategory->slug]) }}">{{ $rootCategory->name }}</a>
                                        @if ($rootCategory->children->isNotEmpty())
                                            <ul class="sub-menu">
                                                @foreach ($rootCategory->children as $child)
                                                    <li
                                                        class="cat-item @if ($child->children->isNotEmpty()) has-children @endif">
                                                        <a
                                                            href="{{ route('botu.products.list', [$child->id, $child->slug]) }}">{{ $child->name }}</a>
                                                        @if ($child->children->isNotEmpty())
                                                            <ul class="sub-menu">
                                                                @foreach ($child->children as $ch)
                                                                    <li class="cat-item">
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
                <div class="col-lg-3">
                    <div class="header-phone">
                        <div class="icon">
                            <i class="fas fa-headphones-alt"></i>
                        </div>
                        <div class="text">
                            <p>Free Support 24/7</p>
                            <p class="font-weight-bold number">+880 12345-67890</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="main-navigation flex-lg-right">
                        <ul class="main-menu menu-right li-last-0">
                            {{-- Books --}}
                            <li class="menu-item has-children">
                                <a href="javascript:void(0)">Books <i
                                        class="fas fa-chevron-down dropdown-arrow"></i></a>
                                <ul class="sub-menu">
                                    @foreach ($rootCategories as $rootCategory)
                                        {{-- @dd($rootCategory->children[0]->name) --}}
                                        <li class="has-children">
                                            <a
                                                href="{{ route('botu.products.list.books', [$rootCategory->id, $rootCategory->slug]) }}">{{ $rootCategory->name }}</a>
                                            @if ($rootCategory->children->isNotEmpty())
                                                <ul class="sub-menu" style="top: 0; left: 80%">
                                                    @foreach ($rootCategory->children as $child)
                                                        <li class="has-children">
                                                            <a
                                                                href="{{ route('botu.products.list.books', [$child->id, $child->slug]) }}">{{ $child->name }}</a>
                                                            @if ($child->children->isNotEmpty())
                                                                <ul class="sub-menu" style="top: 0; left: 80%">
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
                            <li class="menu-item has-children">
                                <a href="javascript:void(0)">Tutorials <i
                                        class="fas fa-chevron-down dropdown-arrow"></i></a>
                                <ul class="sub-menu">
                                    @foreach ($rootCategories as $rootCategory)
                                        {{-- @dd($rootCategory->children[0]->name) --}}
                                        <li class="has-children">
                                            <a
                                                href="{{ route('botu.products.list.tutorials', [$rootCategory->id, $rootCategory->slug]) }}">{{ $rootCategory->name }}</a>
                                            @if (!empty($rootCategory->children))
                                                <ul class="sub-menu" style="top: 0; left: 80%">
                                                    @foreach ($rootCategory->children as $child)
                                                        <li class="has-children">
                                                            <a
                                                                href="{{ route('botu.products.list.tutorials', [$child->id, $child->slug]) }}">{{ $child->name }}</a>
                                                            @if (!empty($child->children))
                                                                <ul class="sub-menu" style="top: 0; left: 80%">
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
                            <li class="menu-item"><a href="{{ route('botu.blog.home') }}">Blog</a></li>
                            {{-- Contact --}}
                            <li class="menu-item">
                                <a href="{{ route('botu.contact') }}">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" style="margin: 10px;" role="alert">
            {{ $error }}
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endforeach
@endif
@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" style="margin: 10px;" role="alert">
        {{ session()->get('success') }}
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" style="margin: 10px;" role="alert">
        {{ session()->get('error') }}
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (session()->has('warning'))
    <div class="alert alert-warning alert-dismissible fade show" style="margin: 10px;" role="alert">
        {{ session()->get('warning') }}
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
{{-- Registration Modal Start --}}
@include('auth.registration_modal')
{{-- Registration Modal End --}}
{{-- Login Modal Start --}}
@include('auth.login_modal')
{{-- Login Modal End --}}
