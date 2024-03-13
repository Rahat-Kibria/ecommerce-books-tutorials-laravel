## Botu Ecommerce (Varsity Project)

Botu Ecommerce is an e-commerce website project built with Laravel.

## Packages Used

-   "barryvdh/laravel-dompdf": "^2.0"
-   "laravel/socialite": "^5.6"
-   "barryvdh/laravel-debugbar": "^3.7"

## API Used

-   [SSLCommerz Sandbox](https://developer.sslcommerz.com/)
-   [Bulk SMS](https://bdbulksms.net/index.php)

## Installation Instructions

-   Clone the repository - `git clone git@bitbucket.org:rahat-kibria/e-commerce-website-2-repo.git`
-   Run `composer install`
-   Run `cp .env-example .env`, if not created automatically
-   Run `php artisan key:generate`, if not generated automatically
-   Run `php artisan serve` to serve the project in browser
-   Run `php artisan migrate --seed`, after creating database

## Core Features

-   user (admin, customer)
-   category
-   product (Book, ebook, audio book, online courses)
-   wishlist
-   cart
-   coupon
-   order
-   order details
-   review rating
-   feedback
-   report
-   blog tag
-   blog post
-   blog comment

## Features

-   Admin can create, read, update and delete categories just like in production
    server. Admin can also show categories in customer panel based on
    requirements.

-   Admin can create, read, update, and delete products in admin panel. Admin can
    also show products based on requirements on customer panel. Related products
    are shown in cart page and product details page. Live search or traditional search
    is included in search box for searching products. Products list can be filtered by
    categories, author/instructor, price (ascending or descending), and name
    (ascending or descending). Video course in product details is locked for those
    who did not purchase the course. pdf and audio files are provided if available.

-   Users are divided into 3 roles - admin, authenticated user and guest. Admin role
    manages/handles admin panel. Authenticated user and guest can purchase
    products from customer panel.

-   Authenticated users can login to their account and can create, read, update and
    delete their account details in customer panel. Authenticated users can view their
    order status, reviews, wishlists, and so on in their account. Socialite login such
    as facebook, google can be used in customer panel. Admin can create login
    details using database seeding feature in Laravel. After login admin can view
    and update account details.

-   Authenticated users cannot get access to admin panel. And Admin credentials
    on the other hand cannot be used in customer panel, nor can be used as
    authenticated user.

-   Both authenticated users and admin can login with username or email address.

-   Only authenticated users can add products to wishlist and can also delete
    products from wishlist. Admin can only view wishlist items.

-   Both authenticated users and guests can add products to cart. They can also view
    and delete cart items from cart page. Admin can view cart items belong to guests
    and can delete if time expires. Admin cannot delete cart items belong to
    authenticated users.

-   Admin can create, read, update, and delete coupons. Users can only apply
    coupons from cart or order checkout page.

-   Both authenticated users and guests can order products. Online payment system
    can be used for payment using sslcommerz sandbox. Sandbox is for local server
    only for testing. Authenticated users can view order status in their accounts.

-   Authenticated users and guests can track orders using order tracking number.
    They can also cancel orders. Admin can view and update the statuses of orders.
    Admin can also delete orders.

-   Order details can be viewed by authenticated users and guests via email. They
    can view details of orders from his/her account. Admin can view order details
    and can also generate pdf invoice using DOM PDF in Laravel. Pdf invoice by
    DOM PDF is also sent to authenticated users and guests after the order is
    completed with the order completed email. They also get SMS for order
    tracking.

-   Both authenticated users and guests can create, update reviews ratings on
    products they purchase. Only authenticated users can view reviews ratings in
    his/her account details. Admin can view and delete reviews ratings and can only
    update status of reviews ratings.

-   Users can create feedback. Admin can view, delete, and only update status of
    feedback.

-   Any user can subscribe to our newsletters by providing their emails.

-   Only admin can generate pdf reports on orders, users, etc.

-   Admin can add, read, modify, and remove blog tags.

-   Admin can add, read, modify, and remove blog posts. Users can browse posts
    by tags, categories, timestamps, and searchbox. Users can post comments on a
    post.

-   Additional features like pagination, password confirmation, fogot password,
    password hide/show, form validation and notification for error, success,
    warning, info are included.

-   Mobile number verification using SMS OTP is used in this project. Also
    customers will get order tracking number after order confirmation in their SMS.

-   Version control system, bitbucket is used in this project for updating and
    reverting of versions of the project.

All of the above mentioned features can be used in production level server except for
the sanbox payment method.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
