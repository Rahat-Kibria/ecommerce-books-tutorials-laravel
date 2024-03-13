@extends('frontend.customer')
@section('content')
    <section class="breadcrumb-section">
        <h2 class="sr-only">Site Breadcrumb</h2>
        <div class="container">
            <div class="breadcrumb-contents">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('botu') }}">Home</a></li>
                        <li class="breadcrumb-item active">Place Order</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <main id="content" class="page-section inner-page-sec-padding-bottom space-db--20">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    {{-- Checkout Form s --}}
                    <div class="checkout-form">
                        <div class="row row-40">
                            <div class="col-12">
                                <h1 class="quick-title">Checkout</h1>
                                @auth
                                    <div class="checkout-quick-box">
                                        <p><span class="btn-sm btn-warning"
                                                style="font-size: 1rem; font-weight: bold;">{{ auth()->user()->first_name }}
                                                {{ auth()->user()->last_name }} </span> <a href="{{ route('botu.logout') }}"
                                                class="btn-sm btn-outlined logout ml--20">Logout and continue as
                                                guest?</a></p>
                                    </div>
                                @else
                                    {{-- Slide Down Trigger  --}}
                                    <div class="checkout-quick-box">
                                        <p><i class="far fa-sticky-note"></i>Returning customer? <a href="javascript:"
                                                class="slide-trigger" data-target="#quick-login">Click
                                                here to login</a></p>
                                    </div>
                                    {{-- Slide Down Blox ==> Login Box  --}}
                                    <div class="checkout-slidedown-box" id="quick-login">
                                        <form action="{{ route('botu.login') }}" method="post" autocomplete="off">
                                            @csrf
                                            @method('put')
                                            <div class="quick-login-form">
                                                <p>If you are a new customer please proceed to the Billing & Shipping section.
                                                </p>
                                                <div class="form-group">
                                                    <label for="quick-user">Username or email *</label>
                                                    <input type="text" name="username" placeholder="Username or email"
                                                        id="quick-user" required>
                                                    @if ($errors->has('username'))
                                                        @foreach ($errors->get('username') as $error)
                                                            <small class="text-danger">{{ $error }}</small>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="quick-pass">Password *</label>
                                                    <input type="text" name="password" placeholder="Password" id="quick-pass"
                                                        required>
                                                    @if ($errors->has('password'))
                                                        @foreach ($errors->get('password') as $error)
                                                            <small class="text-danger">{{ $error }}</small>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <div class="d-flex align-items-center flex-wrap">
                                                        <button type="submit" class="btn btn-outlined mr-3">Login</button>
                                                    </div>
                                                    <p><a href="{{ route('password.request') }}" class="pass-lost mt-3">Lost
                                                            your
                                                            password?</a></p>
                                                </div>
                                                <div class="col-md-12 col-12 mb--15"
                                                    style="align-items: center; color: #ccc; display: flex; margin: 25px 0;">
                                                    <div style="background-color: #ccc; flex-grow: 5; height: 1px;"></div>
                                                    <div style="flex-grow: 1; margin: 0 15px; text-align: center;">or</div>
                                                    <div style="background-color: #ccc; flex-grow: 5; height: 1px;"></div>
                                                </div>
                                                <div class="share-block col-md-12 col-12 mb--15">
                                                    <h3>Login With</h3>
                                                    <div class="social-links justify-content-center">
                                                        <a href="{{ route('login.facebook') }}"
                                                            class="single-social social-rounded"><i
                                                                class="fab fa-facebook-f"></i></a>
                                                        <a href="{{ route('login.google') }}"
                                                            class="single-social social-rounded"><i
                                                                class="fab fa-google"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endauth
                                @if (session()->has('coupon'))
                                    <div class="checkout-quick-box row">
                                        <div class="coupon-text">
                                            <span class="btn btn-warning"
                                                style="font-size: 1rem;">{{ session()->get('coupon')['coupon_code'] }}
                                                ({{ session()->get('coupon')['coupon_discount'] }}%
                                                OFF)</span>
                                        </div>
                                        <div class="coupon-btn ml--20">
                                            <a href="{{ route('botu.clear.session') }}"
                                                class="btn btn-outlined remove-coupon"
                                                onclick="return confirm('Are your sure?')">Remove
                                                coupon</a>
                                        </div>
                                    </div>
                                @else
                                    {{-- Slide Down Trigger  --}}
                                    <div class="checkout-quick-box">
                                        <p><i class="far fa-sticky-note"></i>Have a coupon? <a href="javascript:"
                                                class="slide-trigger" data-target="#quick-cupon">
                                                Click here to enter your code</a></p>
                                    </div>
                                    {{-- Slide Down Blox ==> Cupon Box --}}
                                    <div class="checkout-slidedown-box" id="quick-cupon">
                                        <form action="{{ route('botu.coupon.session.create') }}" method="get">
                                            @csrf
                                            <div class="checkout_coupon">
                                                <input type="text" name="coupon_code" class="mb-0"
                                                    placeholder="Coupon Code">
                                                <input type="submit" class="btn btn-outlined mt--15" value="Apply coupon">
                                                @if ($errors->has('coupon_code'))
                                                    @foreach ($errors->get('coupon_code') as $error)
                                                        <small class="text-danger">{{ $error }}</small>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-7 mb--20">
                                <form action="{{ route('botu.order.submit') }}" method="post" id="place_order_form">
                                    @csrf
                                    @method('put')
                                    {{-- Shipping Address --}}
                                    @auth
                                        <h4 class="checkout-title">Shipping Address</h4>
                                        <div id="billing-form" class="mb-40">
                                            <div class="row">
                                                <div class="col-12 mb--20 ">
                                                    <address style="font-style: italic; font-size: 1rem; font-weight:bold;">
                                                        {{ auth()->user()->first_name }} {{ auth()->user()->last_name }} <br>
                                                        {{ auth()->user()->email }} <br>
                                                        {{ auth()->user()->contact_number }} <br>
                                                        {{ auth()->user()->address }} <br>
                                                        {{ auth()->user()->city }} <br>
                                                        {{ auth()->user()->postal_code }} <br>
                                                        {{ auth()->user()->country }}
                                                    </address>
                                                </div>
                                                <div class="col-12 mb--20 ">
                                                    <div class="block-border check-bx-wrapper">
                                                        <div class="check-box">
                                                            <input type="checkbox" id="create_account" data-shipping>
                                                            <label for="create_account">Do you want to update?</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-40" id="shipping-form">
                                            <div class="row">
                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>First Name*</label>
                                                    <input type="text" name="first_name"
                                                        value="{{ auth()->user()->first_name }}" required>
                                                    @if ($errors->has('first_name'))
                                                        @foreach ($errors->get('first_name') as $error)
                                                            <small class="text-danger">{{ $error }}</small>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Last Name*</label>
                                                    <input type="text" name="last_name"
                                                        value="{{ auth()->user()->last_name }}" required>
                                                    @if ($errors->has('last_name'))
                                                        @foreach ($errors->get('last_name') as $error)
                                                            <small class="text-danger">{{ $error }}</small>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Email Address*</label>
                                                    <input type="email" name="email" value="{{ auth()->user()->email }}"
                                                        required>
                                                    @if ($errors->has('email'))
                                                        @foreach ($errors->get('email') as $error)
                                                            <small class="text-danger">{{ $error }}</small>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Phone no*</label>
                                                    <input type="text" name="contact_number"
                                                        value="{{ auth()->user()->contact_number }}" required>
                                                    @if ($errors->has('contact_number'))
                                                        @foreach ($errors->get('contact_number') as $error)
                                                            <small class="text-danger">{{ $error }}</small>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="address-block col-12 mb--20">
                                                    <label>Address*</label>
                                                    <textarea name="address" required>{{ auth()->user()->address }}</textarea>
                                                    @if ($errors->has('address'))
                                                        @foreach ($errors->get('address') as $error)
                                                            <small class="text-danger">{{ $error }}</small>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Town/City*</label>
                                                    <input type="text" name="city" value="{{ auth()->user()->city }}"
                                                        required>
                                                    @if ($errors->has('city'))
                                                        @foreach ($errors->get('city') as $error)
                                                            <small class="text-danger">{{ $error }}</small>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Zip Code*</label>
                                                    <input type="text" name="postal_code"
                                                        value="{{ auth()->user()->postal_code }}" required>
                                                    @if ($errors->has('postal_code'))
                                                        @foreach ($errors->get('postal_code') as $error)
                                                            <small class="text-danger">{{ $error }}</small>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-12 col-12 mb--20">
                                                    <label>Country*</label>
                                                    <input type="text" name="country"
                                                        value="{{ auth()->user()->country }}" required>
                                                    @if ($errors->has('country'))
                                                        @foreach ($errors->get('country') as $error)
                                                            <small class="text-danger">{{ $error }}</small>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="order-note-block mt--30">
                                            <label for="order-note">Order notes</label>
                                            <textarea id="order-note" name="message" cols="30" rows="10" class="order-note"
                                                placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                        </div>
                                    @else
                                        <div id="billing-form" class="mb-40">
                                            <h4 class="checkout-title">Shipping Address</h4>
                                            <div class="row">
                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>First Name*</label>
                                                    <input type="text" name="first_name" placeholder="First Name"
                                                        required>
                                                    @if ($errors->has('first_name'))
                                                        @foreach ($errors->get('first_name') as $error)
                                                            <small class="text-danger">{{ $error }}</small>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Last Name*</label>
                                                    <input type="text" name="last_name" placeholder="Last Name" required>
                                                    @if ($errors->has('last_name'))
                                                        @foreach ($errors->get('last_name') as $error)
                                                            <small class="text-danger">{{ $error }}</small>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Email Address*</label>
                                                    <input type="email" name="email" placeholder="Email Address"
                                                        required>
                                                    @if ($errors->has('email'))
                                                        @foreach ($errors->get('email') as $error)
                                                            <small class="text-danger">{{ $error }}</small>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Phone no (OTP will be sent to verify)*</label>
                                                    <input type="text" name="contact_number" placeholder="Phone number"
                                                        required>
                                                    @if ($errors->has('contact_number'))
                                                        @foreach ($errors->get('contact_number') as $error)
                                                            <small class="text-danger">{{ $error }}</small>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="address-block col-12 mb--20">
                                                    <label>Address*</label>
                                                    <textarea name="address" placeholder="Address" required></textarea>
                                                    @if ($errors->has('address'))
                                                        @foreach ($errors->get('address') as $error)
                                                            <small class="text-danger">{{ $error }}</small>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Town/City*</label>
                                                    <input type="text" name="city" placeholder="Town/City" required>
                                                    @if ($errors->has('city'))
                                                        @foreach ($errors->get('city') as $error)
                                                            <small class="text-danger">{{ $error }}</small>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Zip Code*</label>
                                                    <input type="text" name="postal_code" placeholder="Zip Code" pattern="[0-9]" required>
                                                    @if ($errors->has('postal_code'))
                                                        @foreach ($errors->get('postal_code') as $error)
                                                            <small class="text-danger">{{ $error }}</small>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-12 col-12 mb--20">
                                                    <label>Country*</label>
                                                    <input type="text" name="country" placeholder="Country" required>
                                                    @if ($errors->has('country'))
                                                        @foreach ($errors->get('country') as $error)
                                                            <small class="text-danger">{{ $error }}</small>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-12 mb--20 ">
                                                    <div class="block-border check-bx-wrapper">
                                                        <div class="check-box">
                                                            <input type="checkbox" id="create_account" data-shipping>
                                                            <label for="create_account">Create an Acount?</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Become auth user by providing username password --}}
                                        <div id="shipping-form">
                                            <div class="row">
                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Username*</label>
                                                    <input type="text" name="username" placeholder="Username">
                                                    @if ($errors->has('username'))
                                                        @foreach ($errors->get('username') as $error)
                                                            <small class="text-danger">{{ $error }}</small>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Password*</label>
                                                    <input type="password" name="password" placeholder="Password">
                                                    @if ($errors->has('password'))
                                                        @foreach ($errors->get('password') as $error)
                                                            <small class="text-danger">{{ $error }}</small>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="order-note-block mt--30">
                                            <label for="order-note">Order notes</label>
                                            <textarea id="order-note" name="message" cols="30" rows="10" class="order-note"
                                                placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                        </div>
                                    @endauth
                                </form>
                            </div>
                            <div class="col-lg-5">
                                <div class="row">
                                    {{-- Cart Total --}}
                                    <div class="col-12">
                                        <div class="checkout-cart-total">
                                            <h2 class="checkout-title">YOUR ORDER</h2>
                                            <h4>Product <span>Total</span></h4>
                                            <ul>
                                                @if (isset($cart_products) && !empty($cart_products))
                                                    @forelse ($cart_products as $cart_product)
                                                        @php
                                                            $product_price = $cart_product->product->price - ($cart_product->product->price * $cart_product->product->discount) / 100;
                                                        @endphp
                                                        <li><span class="left">{{ $cart_product->product->name }} X
                                                                {{ $cart_product->quantity }}</span> <span
                                                                class="right">৳{{ $cart_product->quantity * $product_price }}</span>
                                                        </li>
                                                    @empty
                                                        <li>
                                                            <p class="alert alert-danger">Please select a product to
                                                                continue</p>
                                                        </li>
                                                    @endforelse
                                                @endif
                                            </ul>
                                            @php
                                                if (auth()->check()) {
                                                    $cart_items = App\Models\Cart::all()->where('user_id', auth()->user()->id);
                                                } else {
                                                    $cart_items = App\Models\Cart::all()->where('ip_address', request()->ip());
                                                }
                                                $total_cart_price = $cart_items->sum(function ($total) {
                                                    $product_price = $total->product->price - ($total->product->price * $total->product->discount) / 100;
                                                    return $product_price * $total->quantity;
                                                });
                                            @endphp
                                            @if (session()->has('coupon'))
                                                <p>Sub Total
                                                    <span>৳{{ $total_cart_price - ($total_cart_price * session()->get('coupon')['coupon_discount']) / 100 }}</span>
                                                </p>
                                                <p>Shipping Fee <span>৳{{ 50 }}</span></p>
                                                <h4>Grand Total
                                                    <span>৳{{ $total_cart_price - ($total_cart_price * session()->get('coupon')['coupon_discount']) / 100 + 50 }}</span>
                                                </h4>
                                                <input type="hidden" name="total" form="place_order_form"
                                                    value="{{ $total_cart_price - ($total_cart_price * session()->get('coupon')['coupon_discount']) / 100 }}">
                                                <input type="hidden" name="grand_total" form="place_order_form"
                                                    value="{{ $total_cart_price - ($total_cart_price * session()->get('coupon')['coupon_discount']) / 100 + 50 }}">
                                            @else
                                                <p>Sub Total <span>৳{{ $total_cart_price }}</span></p>
                                                <p>Shipping Fee <span>৳{{ 50 }}</span></p>
                                                <h4>Grand Total <span>৳{{ $total_cart_price + 50 }}</span></h4>
                                                <input type="hidden" name="total" form="place_order_form"
                                                    value="{{ $total_cart_price }}">
                                                <input type="hidden" name="grand_total" form="place_order_form"
                                                    value="{{ $total_cart_price + 50 }}">
                                            @endif
                                            <div class="payment-type my--25">
                                                <h3>Payment Type</h3><br>
                                                <input type="radio" name="payment_type" id="cash_on_delivery"
                                                    form="place_order_form" value="cash on delivery" checked>
                                                <label for="cash_on_delivery">Cash On Delivery</label>
                                                <br>
                                                <input type="radio" name="payment_type" id="online_payment"
                                                    form="place_order_form" value="online payment">
                                                <label for="online_payment">Online Payment</label>
                                            </div>
                                            <div class="term-block">
                                                <input type="checkbox" id="accept_terms2" name="terms_conditions"
                                                    form="place_order_form">
                                                <label for="accept_terms2">I’ve read and accept the <a
                                                        href="{{ route('botu.terms_and_conditions') }}"
                                                        style="text-decoration: underline">terms &
                                                        conditions</a></label>
                                            </div>
                                            <button type="submit" class="place-order w-100"
                                                form="place_order_form">Place order</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
