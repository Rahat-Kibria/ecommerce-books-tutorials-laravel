<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                {{-- Categories --}}
                {{-- @dd(request()->route->named('admin.categories.list')) --}}
                <a class="rounded {{ request()->routeIs('admin.categories.list', 'admin.category.form', 'admin.category.view', 'admin.category.update') ? 'nav-link active' : 'nav-link' }}"
                    href="#categories" data-bs-toggle="collapse" aria-expanded="false">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-layer-group"></i></div>
                    Category
                </a>
                <ul class="list-group collapse {{ request()->routeIs('admin.categories.list', 'admin.category.form', 'admin.category.view', 'admin.category.update') ? 'show' : '' }}"
                    id="categories">
                    <li><a class="list-group-item mt-1 ms-3 rounded {{ request()->routeIs('admin.categories.list', 'admin.category.view', 'admin.category.update') ? 'nav-link active show' : 'nav-link show' }}"
                            href="{{ route('admin.categories.list') }}">Categories List</a></li>
                    <li><a class="list-group-item mt-1 ms-3 rounded {{ request()->routeIs('admin.category.form') ? 'nav-link active show' : 'nav-link' }}"
                            href="{{ route('admin.category.form') }}">Add Category</a></li>
                </ul>
                {{-- Products --}}
                <a class="rounded {{ request()->routeIs('admin.products.list', 'admin.product.form', 'admin.product.view', 'admin.product.edit') ? 'nav-link active' : 'nav-link' }}"
                    href="#products" data-bs-toggle="collapse" aria-expanded="false">
                    <div class="sb-nav-link-icon"><i class="fa-sharp fa-solid fa-cubes"></i></div>
                    Products
                </a>
                <ul class="list-group collapse {{ request()->routeIs('admin.products.list', 'admin.product.form', 'admin.product.view', 'admin.product.edit') ? 'show' : '' }}"
                    id="products">
                    <li><a class="list-group-item mt-1 ms-3 rounded {{ request()->routeIs('admin.products.list', 'admin.product.view', 'admin.product.edit') ? 'nav-link active show' : 'nav-link show' }}"
                            href="{{ route('admin.products.list') }}">Products List</a></li>
                    <li><a class="list-group-item mt-1 ms-3 rounded {{ request()->routeIs('admin.product.form') ? 'nav-link active show' : 'nav-link' }}"
                            href="{{ route('admin.product.form') }}">Add Product</a></li>
                </ul>
                {{-- Audio --}}
                <a class="rounded {{ request()->routeIs('admin.audios.list', 'admin.audio.create', 'admin.audio.view', 'admin.audio.edit') ? 'nav-link active' : 'nav-link' }}"
                    href="#audios" data-bs-toggle="collapse" aria-expanded="false">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-music"></i></div>
                    Audios
                </a>
                <ul class="list-group collapse {{ request()->routeIs('admin.audios.list', 'admin.audio.create', 'admin.audio.view', 'admin.audio.edit') ? 'show' : '' }}"
                    id="audios">
                    <li><a class="list-group-item mt-1 ms-3 rounded {{ request()->routeIs('admin.audios.list', 'admin.audio.view', 'admin.audio.edit') ? 'nav-link active show' : 'nav-link show' }}"
                            href="{{ route('admin.audios.list') }}">Audios List</a></li>
                    <li><a class="list-group-item mt-1 ms-3 rounded {{ request()->routeIs('admin.audio.create') ? 'nav-link active show' : 'nav-link' }}"
                            href="{{ route('admin.audio.create') }}">Add Audio</a></li>
                </ul>
                {{-- Ebook --}}
                <a class="rounded {{ request()->routeIs('admin.ebooks.list', 'admin.ebook.create', 'admin.ebook.view', 'admin.ebook.edit') ? 'nav-link active' : 'nav-link' }}"
                    href="#ebooks" data-bs-toggle="collapse" aria-expanded="false">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-file-pdf"></i></div>
                    Ebooks
                </a>
                <ul class="list-group collapse {{ request()->routeIs('admin.ebooks.list', 'admin.ebook.create', 'admin.ebook.view', 'admin.ebook.edit') ? 'show' : '' }}"
                    id="ebooks">
                    <li><a class="list-group-item mt-1 ms-3 rounded {{ request()->routeIs('admin.ebooks.list', 'admin.ebook.view', 'admin.ebook.edit') ? 'nav-link active show' : 'nav-link show' }}"
                            href="{{ route('admin.ebooks.list') }}">Ebooks List</a></li>
                    <li><a class="list-group-item mt-1 ms-3 rounded {{ request()->routeIs('admin.ebook.create') ? 'nav-link active show' : 'nav-link' }}"
                            href="{{ route('admin.ebook.create') }}">Add Ebook</a></li>
                </ul>
                {{-- Customers --}}
                <a class="{{ request()->routeIs('admin.customers.list', 'admin.customer.view') ? 'nav-link active' : 'nav-link' }}"
                    href="{{ route('admin.customers.list') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-people-group"></i></div>
                    Customer
                </a>
                {{-- wishlist --}}
                <a class="{{ request()->routeIs('admin.wishlists.list', 'admin.wishlist.view') ? 'nav-link active' : 'nav-link' }}"
                    href="{{ route('admin.wishlists.list') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-heart"></i></div>
                    Wishlist
                </a>
                {{-- Cart --}}
                <a class="{{ request()->routeIs('admin.carts.list') ? 'nav-link active' : 'nav-link' }}"
                    href="{{ route('admin.carts.list') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                    Cart
                </a>
                {{-- Coupons --}}
                <a class="rounded {{ request()->routeIs('admin.coupons.list', 'admin.coupon.add', 'admin.coupon.view', 'admin.coupon.edit') ? 'nav-link active' : 'nav-link' }}"
                    href="#coupons" data-bs-toggle="collapse" aria-expanded="false">
                    <div class="sb-nav-link-icon"><i class="fa-sharp fa-solid fa-cubes"></i></div>
                    Coupons
                </a>
                <ul class="list-group collapse {{ request()->routeIs('admin.coupons.list', 'admin.coupon.add', 'admin.coupon.view', 'admin.coupon.edit') ? 'show' : '' }}"
                    id="coupons">
                    <li><a class="list-group-item mt-1 ms-3 rounded {{ request()->routeIs('admin.coupons.list', 'admin.coupon.view', 'admin.coupon.edit') ? 'nav-link active show' : 'nav-link show' }}"
                            href="{{ route('admin.coupons.list') }}">Coupons List</a></li>
                    <li><a class="list-group-item mt-1 ms-3 rounded {{ request()->routeIs('admin.coupon.add') ? 'nav-link active show' : 'nav-link' }}"
                            href="{{ route('admin.coupon.add') }}">Add Coupon</a></li>
                </ul>
                {{-- Orders --}}
                <a class="{{ request()->routeIs('admin.orders.list', 'admin.order.edit', 'admin.order.details.view') ? 'nav-link active' : 'nav-link' }}"
                    href="{{ route('admin.orders.list') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-bag-shopping"></i></div>
                    Orders
                </a>
                {{-- Reviews Ratings --}}
                <a class="{{ request()->routeIs('admin.reviews.list', 'admin.review.edit', 'admin.review.view') ? 'nav-link active' : 'nav-link' }}"
                    href="{{ route('admin.reviews.list') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-star"></i></div>
                    Reviews
                </a>
                {{-- Feedback/Contact --}}
                <a class="{{ request()->routeIs('admin.feedbacks.list', 'admin.feedback.view') ? 'nav-link active' : 'nav-link' }}"
                    href="{{ route('admin.feedbacks.list') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-envelope"></i></div>
                    Feedback
                </a>
                {{-- Newsletter Subscription --}}
                <a class="{{ request()->routeIs('admin.subscription.emails') ? 'nav-link active' : 'nav-link' }}"
                    href="{{ route('admin.subscription.emails') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-envelope"></i></div>
                    Subscription Emails
                </a>
                {{-- Courier --}}
                <a class="{{ request()->routeIs('admin.couriers.list') ? 'nav-link active' : 'nav-link' }}"
                    href="{{ route('admin.couriers.list') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-truck-fast"></i></div>
                    Courier
                </a>
                {{-- Report --}}
                <a class="rounded {{ request()->routeIs('admin.report.orders') ? 'nav-link active' : 'nav-link' }}"
                    href="#reports" data-bs-toggle="collapse" aria-expanded="false">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-scroll"></i></div>
                    Reports
                </a>
                <ul class="list-group collapse {{ request()->routeIs('admin.report.orders') ? 'show' : '' }}"
                    id="reports">
                    <li><a class="list-group-item mt-1 ms-3 rounded {{ request()->routeIs('admin.report.orders') ? 'nav-link active show' : 'nav-link show' }}"
                            href="{{ route('admin.report.orders') }}">Orders Report</a></li>
                </ul>
                {{-- Tags --}}
                <a class="rounded {{ request()->routeIs('tag.index', 'tag.create', 'tag.show', 'tag.edit') ? 'nav-link active' : 'nav-link' }}"
                    href="#tags" data-bs-toggle="collapse" aria-expanded="false">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-tag"></i></div>
                    Tags
                </a>
                <ul class="list-group collapse {{ request()->routeIs('tag.index', 'tag.create', 'tag.show', 'tag.edit') ? 'show' : '' }}"
                    id="tags">
                    <li><a class="list-group-item mt-1 ms-3 rounded {{ request()->routeIs('tag.index', 'tag.show', 'tag.edit') ? 'nav-link active show' : 'nav-link show' }}"
                            href="{{ route('tag.index') }}">Tags List</a></li>
                    <li><a class="list-group-item mt-1 ms-3 rounded {{ request()->routeIs('tag.create') ? 'nav-link active show' : 'nav-link' }}"
                            href="{{ route('tag.create') }}">Create tag</a></li>
                </ul>
                {{-- Post --}}
                <a class="rounded {{ request()->routeIs('admin.post.index', 'admin.post.create', 'admin.post.show', 'admin.post.edit') ? 'nav-link active' : 'nav-link' }}"
                    href="#posts" data-bs-toggle="collapse" aria-expanded="false">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-scroll"></i></div>
                    Posts
                </a>
                <ul class="list-group collapse {{ request()->routeIs('admin.post.index', 'admin.post.create', 'admin.post.show', 'admin.post.edit') ? 'show' : '' }}"
                    id="posts">
                    <li><a class="list-group-item mt-1 ms-3 rounded {{ request()->routeIs('admin.post.index', 'admin.post.show', 'admin.post.edit') ? 'nav-link active show' : 'nav-link show' }}"
                            href="{{ route('admin.post.index') }}">Posts List</a></li>
                    <li><a class="list-group-item mt-1 ms-3 rounded {{ request()->routeIs('admin.post.create') ? 'nav-link active show' : 'nav-link' }}"
                            href="{{ route('admin.post.create') }}">Create post</a></li>
                </ul>
            </div>
            {{-- Admin Name --}}
            <div class="me-md-4">
                <div class="small" style="color: #62ab00">Logged in as</div>
                <div style="color: #FFf; background: #62ab00; text-align:center; border-radius:10px"
                    class="text-uppercase">
                    {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</div>
            </div>
        </div>
    </nav>
</div>
