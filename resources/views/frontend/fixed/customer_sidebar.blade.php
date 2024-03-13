<div class="col-lg-3 col-12">
    <div class="myaccount-tab-menu nav">
        <a href="{{ route('botu.account.dashboard') }}"
            class="{{ request()->routeIs('botu.account.dashboard') ? 'active' : '' }}"><i
                class="fas fa-tachometer-alt"></i>
            Dashboard</a>
        <a href="{{ route('botu.account.details') }}"
            class="{{ request()->routeIs('botu.account.details') ? 'active' : '' }}"><i class="fa fa-user"></i> Account
            Details</a>
        <a href="{{ route('botu.account.my_address') }}"
            class="{{ request()->routeIs('botu.account.my_address') ? 'active' : '' }}"><i class="fa fa-map-marker"></i>
            My Address</a>
        <a href="{{ route('botu.account.my_orders') }}"
            class="{{ request()->routeIs('botu.account.my_orders', 'botu.account.my_order.details') ? 'active' : '' }}"><i
                class="fa fa-cart-arrow-down"></i> My Orders</a>
        <a href="{{ route('botu.account.my_returns') }}"
            class="{{ request()->routeIs('botu.account.my_returns') ? 'active' : '' }}"><i class="fa fa-arrow-left"></i>
            My Returns</a>
        <a class="{{ request()->routeIs('botu.account.my_reviews_history', 'botu.account.my_reviews_pending', 'botu.account.my_review.create', 'botu.account.my_review.edit') ? 'active' : '' }}"
            href="javascript:" id="my_reviews"><i class="fa fa-star"></i> My
            Reviews
            Ratings</a>
        <ul
            class="list-group collapse {{ request()->routeIs('botu.account.my_reviews_history', 'botu.account.my_reviews_pending', 'botu.account.my_review.create', 'botu.account.my_review.edit') ? 'show' : '' }}">
            <li><a class="list-group-item mt-1 ml-3 rounded {{ request()->routeIs('botu.account.my_reviews_history', 'botu.account.my_review.edit') ? 'nav-link active show' : 'nav-link show' }}"
                    href="{{ route('botu.account.my_reviews_history') }}">History</a></li>
            <li><a class="list-group-item mt-1 ml-3 rounded {{ request()->routeIs('botu.account.my_reviews_pending', 'botu.account.my_review.create') ? 'nav-link active show' : 'nav-link' }}"
                    href="{{ route('botu.account.my_reviews_pending') }}">To be reviewd</a></li>
        </ul>
        <a href="{{ route('botu.account.my_courses') }}"
            class="{{ request()->routeIs('botu.account.my_courses') ? 'active' : '' }}"><i class="fas fa-download"></i>
            My Courses</a>
        <a href="{{ route('botu.account.my_audio_books') }}"
            class="{{ request()->routeIs('botu.account.my_audio_books') ? 'active' : '' }}"><i
                class="fas fa-download"></i> My Audio Books</a>
        <a href="{{ route('botu.account.my_ebooks') }}"
            class="{{ request()->routeIs('botu.account.my_ebooks') ? 'active' : '' }}"><i class="fas fa-download"></i>
            My Ebooks</a>
        <a href="{{ route('botu.account.my_payment_method') }}"
            class="{{ request()->routeIs('botu.account.my_payment_method') ? 'active' : '' }}"><i
                class="fa fa-credit-card"></i>
            My Payment
            Method</a>
        <a href="{{ route('botu.logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>
