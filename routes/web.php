<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\TagController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\CartController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\backend\EbookController;
use App\Http\Controllers\backend\AudioController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\CouponController;
use App\Http\Controllers\backend\ReportController;
use App\Http\Controllers\backend\ReviewController;
use App\Http\Controllers\backend\CourierController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\FeedbackController;
use App\Http\Controllers\backend\WishlistController;
use App\Http\Controllers\frontend\AuthController;
use App\Http\Controllers\frontend\WebsiteController;
use App\Http\Controllers\frontend\BlogCommentController;
use App\Http\Controllers\frontend\SslCommerzPaymentController;
use App\Http\Controllers\frontend\UserController as WebUserController;
use App\Http\Controllers\frontend\CartController as WebCartController;
use App\Http\Controllers\frontend\PostController as WebPostController;
use App\Http\Controllers\frontend\OrderController as WebOrderController;
use App\Http\Controllers\frontend\ReviewController as WebReviewController;
use App\Http\Controllers\frontend\ProductController as WebProductController;
use App\Http\Controllers\frontend\FeedbackController as WebFeedbackController;
use App\Http\Controllers\frontend\WishlistController as WebWishlistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/laravel', function () {
    return view('welcome');
})->name('laravel');
//=========Website==============
Route::group(['middleware' => 'checkCustomer'], function () {
    Route::get('/', [WebsiteController::class, 'botu'])->name('botu');

    // ################# Login ####################
    Route::get('/login_registration/page', [WebUserController::class, 'login_registration_page'])->name('botu.login.registration.page')->middleware('guest');
    Route::post('/registration', [WebUserController::class, 'registration'])->name('botu.registration');
    Route::put('/login', [WebUserController::class, 'login'])->name('botu.login');

    //################# Password Reset ###################
    Route::get('/forgot-password/eyJpdiI6ImsvMndYVHB1Z3JubEcr7b', [AuthController::class, 'forgot_password_page'])->name('password.request');
    Route::post('/forgot-password/eyJpdiI6ImsvMndYVHB1Z3JubEcr7b', [AuthController::class, 'password_email_sent'])->name('password.email.sent');
    Route::get('/reset-password/{token}', [AuthController::class, 'password_reset_page'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'password_update'])->name('password.update');

    //################# OTP Verify ###################
    Route::post('/opt/check', [AuthController::class, 'otp_check'])->name('botu.otp.check');
    Route::post('/opt/in/checkout', [WebOrderController::class, 'otp_in_checkout'])->name('botu.otp.in.checkout');

    //################# Socialite Login ###################
    Route::get('/auth/google/redirect', [AuthController::class, 'auth_google_redirect'])->name('login.google');
    Route::get('/auth/google/callback', [AuthController::class, 'auth_google_callback']);
    Route::get('/auth/facebook/redirect', [AuthController::class, 'auth_facebook_redirect'])->name('login.facebook');
    Route::get('/auth/facebook/callback', [AuthController::class, 'auth_facebook_callback']);
    Route::put('/socialite/password/update/{user_id}', [AuthController::class, 'solialite_password_update'])->name('socialite.password.update');
    Route::put('/socialite/contact/update/', [AuthController::class, 'solialite_contact_update'])->name('socialite.contact.update');
    // stateless problem:
    // go to: vendor/laravel/socialite/src/Two/AbstractProvider.php and change like bellow
    // protected $stateless = true;
    // ssl certificate problem:
    // go to: vendor/guzzlehttp/guzzle/src/Handler/CurlFactory.php and change like bellow
    // $conf[\CURLOPT_SSL_VERIFYHOST] = 0;
    // $conf[\CURLOPT_SSL_VERIFYPEER] = false;

    //################# Products ###################
    Route::get('/category/{id}/{slug}/products', [WebProductController::class, 'view_products_list'])->name('botu.products.list');
    Route::get('/category/{id}/{slug}/books', [WebProductController::class, 'view_products_list_books'])->name('botu.products.list.books');
    Route::get('/category/{id}/{slug}/tutorials', [WebProductController::class, 'view_products_list_tutorials'])->name('botu.products.list.tutorials');
    Route::get('/products/books', [WebProductController::class, 'view_products_books'])->name('botu.products.books');
    Route::get('/products/tutorials', [WebProductController::class, 'view_products_tutorials'])->name('botu.products.tutorials');
    Route::get('/products/free_books', [WebProductController::class, 'view_free_books'])->name('botu.free.books');
    Route::get('/products/free_tutorials', [WebProductController::class, 'view_free_tutorials'])->name('botu.free.tutorials');
    Route::get('/products/50_percent_off', [WebProductController::class, 'fifty_percent_off'])->name('botu.fifty_percent_off');
    Route::get('/search/products', [WebProductController::class, 'search_products'])->name('botu.search.products');
    Route::get('/search/products/ajax', [WebProductController::class, 'search_products_ajax'])->name('botu.search.products.ajax');
    Route::get('/products/featured', [WebProductController::class, 'featured_products'])->name('botu.products.featured');
    Route::get('/products/new_arrivals', [WebProductController::class, 'new_arrivals_products'])->name('botu.products.new_arrivals');
    Route::get('/products/most_viewed', [WebProductController::class, 'most_viewed_products'])->name('botu.products.most_viewed');
    Route::get('/product/details/{id?}/{slug?}', [WebProductController::class, 'view_product_details'])->name('botu.product.details');
    Route::get('/product/tutorial/details/{id?}/{slug?}', [WebProductController::class, 'view_tutorial_details'])->name('botu.tutorial.details');

    //################# Author/Instructor ###################
    Route::get('/author/instructor/{name}', [WebsiteController::class, 'author_instructor_page'])->name('botu.author.instructor');

    //################# Cart ###################
    Route::post('/add_to_cart/{product_id}', [WebCartController::class, 'add_to_cart'])->name('botu.add_to_cart');
    Route::get('/cart_item/delete/{cart_id}', [WebCartController::class, 'cart_item_delete'])->name('botu.cart.delete');
    Route::get('/cart/page', [WebCartController::class, 'cart'])->name('botu.cart');
    Route::put('/cart/update/', [WebCartController::class, 'cart_update_multi'])->name('botu.cart.update.multi');
    Route::put('/cart/update/{product_id?}', [WebCartController::class, 'cart_update_single'])->name('botu.cart.update.single');

    // ################ Session ##############
    Route::get('/coupon/session/create', [WebCartController::class, 'coupon_session_create'])->name('botu.coupon.session.create');
    Route::get('/clear/session', [WebsiteController::class, 'clear_session'])->name('botu.clear.session');

    // ################ Wishlist ##############
    Route::post('/add_to_wishlist/{product_id?}', [WebWishlistController::class, 'add_to_wishlist'])->name('botu.add_to_wishlist');
    Route::get('/wishlist_item/delete/{wishlist_id}', [WebWishlistController::class, 'wishlist_item_delete'])->name('botu.wishlist.delete');

    // ################ Orders ################
    Route::get('/order/checkout/page', [WebOrderController::class, 'order_checkout_page'])->name('botu.order.checkout.page');
    Route::put('/order/submit', [WebOrderController::class, 'order_submit'])->name('botu.order.submit');
    Route::get('/order/complete', [WebOrderController::class, 'order_complete'])->name('botu.order.complete');
    Route::get('/order/track', [WebOrderController::class, 'order_track'])->name('botu.order.track');
    Route::get('/order/track/number', [WebOrderController::class, 'order_track_number_details'])->name('botu.order.track.number');
    Route::post('/order/cancel/{order_id}', [WebOrderController::class, 'order_cancel'])->name('botu.order.cancel');

    // ################ SSLCOMMERZ Payment Gateway ##############
    Route::post('/success', [SslCommerzPaymentController::class, 'success']);
    Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
    Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
    Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);

    // ################# Product Review ###############
    Route::put('/product/review', [WebReviewController::class, 'product_review'])->name('botu.product.review');

    // ################# Blogs ###############
    Route::get('/blog/home', [WebPostController::class, 'blog_home'])->name('botu.blog.home');
    Route::get('/blog/details/{post_id}', [WebPostController::class, 'blog_details'])->name('botu.blog.details');
    Route::get('/blog/search/post', [WebPostController::class, 'blog_search_post'])->name('botu.blog.search.post');
    Route::get('/blog/posts/{year}', [WebPostController::class, 'blog_posts_by_year'])->name('botu.blog.posts.by.year');
    Route::get('/blog/posts/category/{category_id?}', [WebPostController::class, 'blog_posts_by_category'])->name('botu.blog.posts.by.category');
    Route::get('/blog/posts/tag/{tag_id?}', [WebPostController::class, 'blog_posts_by_tag'])->name('botu.blog.posts.by.tag');

    // ################# Comments ###############
    Route::post('/blog/comment/store/{post_id}', [BlogCommentController::class, 'blog_comment_store'])->name('botu.blog.comment.store');

    // ################# Feedback ###############
    Route::get('/contact', [WebFeedbackController::class, 'contact'])->name('botu.contact');
    Route::post('/feedback/submit', [WebFeedbackController::class, 'feedback_submit'])->name('botu.feedback.submit');

    // ################# Valueless Stuff ###############
    Route::get('/faq', [WebsiteController::class, 'faq'])->name('botu.faq');
    Route::get('/terms_and_conditions', [WebsiteController::class, 'terms_and_conditions'])->name('botu.terms_and_conditions');
    Route::post('/subscribe/newsletter', [WebsiteController::class, 'subscribe_newsletter'])->name('botu.subscribe.newsletter');

    // ################# User Account #################
    Route::group(['middleware' => 'authUser'], function () {
        Route::get('/logout', [WebUserController::class, 'logout'])->name('botu.logout');
        Route::get('/account', [WebUserController::class, 'account_dashboard'])->name('botu.account.dashboard');
        Route::get('/account/details', [WebUserController::class, 'account_details'])->name('botu.account.details');
        Route::get('/account/my_address', [WebUserController::class, 'my_address'])->name('botu.account.my_address');
        Route::put('/account/update', [WebUserController::class, 'account_details_update'])->name('botu.account.details.update');
        Route::put('/account/update/image', [WebUserController::class, 'account_details_update_image'])->name('botu.account.details.update.image');
        Route::put('/account/update/password', [WebUserController::class, 'account_details_update_password'])->name('botu.account.details.update.password');
        Route::get('/account/delete', [WebUserController::class, 'account_delete'])->name('botu.account.delete');
        Route::post('/account/address/create', [WebUserController::class, 'my_address_create'])->name('botu.account.my_address.create');
        Route::put('/account/address/update', [WebUserController::class, 'my_address_update'])->name('botu.account.my_address.update');

        // ################# User Wishlist #################
        Route::get('/account/wishlist', [WebWishlistController::class, 'wishlist_page'])->name('botu.account.wishlist');

        // ################# User Orders #################
        Route::get('/account/my_orders', [WebOrderController::class, 'my_orders'])->name('botu.account.my_orders');
        Route::get('/account/my_order/details/{order_id}', [WebOrderController::class, 'my_order_details'])->name('botu.account.my_order.details');
        Route::get('/account/my_returns', [WebOrderController::class, 'my_returns'])->name('botu.account.my_returns');
        Route::get('/account/my_courses', [WebOrderController::class, 'my_courses'])->name('botu.account.my_courses');
        Route::get('/account/my_audio_books', [WebOrderController::class, 'my_audio_books'])->name('botu.account.my_audio_books');
        Route::get('/account/my_ebooks', [WebOrderController::class, 'my_ebooks'])->name('botu.account.my_ebooks');

        // ################# User Payment #################
        Route::get('/account/my_payment_method', [WebUserController::class, 'my_payment_method'])->name('botu.account.my_payment_method');

        //############## User Rating Reviews ##############
        Route::get('/account/my_reviews_history', [WebReviewController::class, 'my_reviews_history'])->name('botu.account.my_reviews_history');
        Route::get('/account/my_reviews_pending', [WebReviewController::class, 'my_reviews_pending'])->name('botu.account.my_reviews_pending');
        Route::get('/account/my_review/create/{product_id}', [WebReviewController::class, 'my_review_create'])->name('botu.account.my_review.create');
        Route::post('/account/my_review/submit', [WebReviewController::class, 'my_review_submit'])->name('botu.account.my_review.submit');
        Route::get('/account/my_review/edit/{product_id}', [WebReviewController::class, 'my_review_edit'])->name('botu.account.my_review.edit');
        Route::put('/account/my_review/update/{product_review_id}', [WebReviewController::class, 'my_review_update'])->name('botu.account.my_review.update');
    });
});

//############# Admin ###################
Route::group(['prefix' => 'admin'], function () {

    //################ Admin Authentication ################
    Route::get('/login/eyJpdiI6ImsvMndYVHB1Z3JubEcr7b', [UserController::class, 'admin_login'])->name('admin.login');
    Route::post('/login/submit', [UserController::class, 'admin_login_submit'])->name('admin.login.submit');
    Route::group(['middleware' => ['auth', 'checkAdmin']], function () {
        Route::get('/logout', [UserController::class, 'admin_logout'])->name('admin.logout');

        //################# Admin #################
        Route::get('/', [UserController::class, 'admin_dashboard'])->name('admin.dashboard');
        Route::get('/account_details', [UserController::class, 'admin_details'])->name('admin.details');
        Route::put('/account_details/update', [UserController::class, 'admin_details_update'])->name('admin.details.update');
        Route::post('/account/image/create', [UserController::class, 'admin_image_create'])->name('admin.image.create');
        Route::put('/account/image/update', [UserController::class, 'admin_image_update'])->name('admin.image.update');
        Route::put('/account/username_email/update', [UserController::class, 'admin_username_email_update'])->name('admin.username_email.update');
        Route::put('/account/password/change', [UserController::class, 'admin_password_change'])->name('admin.password.change');

        //#################### Customer ####################
        Route::get('/customers', [UserController::class, 'customers_list'])->name('admin.customers.list');
        Route::get('/customer/view/{user_id}', [UserController::class, 'customer_view'])->name('admin.customer.view');
        Route::get('/customer/delete/{user_id}', [UserController::class, 'customer_delete'])->name('admin.customer.delete');

        //################### Category ###################
        Route::get('/categories', [CategoryController::class, 'categories_list'])->name('admin.categories.list');
        Route::get('/category/form', [CategoryController::class, 'category_form'])->name('admin.category.form');
        Route::post('/category/form/submit', [CategoryController::class, 'category_form_submit'])->name('admin.category.form.submit');
        Route::get('/category/view/{category_id}', [CategoryController::class, 'viewCategory'])->name('admin.category.view');
        Route::get('/category/delete/{category_id}', [CategoryController::class, 'deleteCategory'])->name('admin.category.delete');
        Route::get('/category/update/{category_id}', [CategoryController::class, 'updateCategory'])->name('admin.category.update');
        Route::put('/category/update/submit/{category_id}', [CategoryController::class, 'updateCategorySubmit'])->name('admin.category.update.submit');
        Route::put('/category/image/delete/{category_id}/{image_name}', [CategoryController::class, 'category_image_delete'])->name('admin.category.image.delete');

        //################# Products #################
        Route::get('/products', [ProductController::class, 'products_list'])->name('admin.products.list');
        Route::get('/product/form', [ProductController::class, 'product_form'])->name('admin.product.form');
        Route::post('/product/form/submit', [ProductController::class, 'product_form_submit'])->name('admin.product.form.submit');
        Route::get('/product/view/{product_id?}/{product_slug?}', [ProductController::class, 'view_product'])->name('admin.product.view');
        Route::get('/product/delete/{product_id}', [ProductController::class, 'delete_product'])->name('admin.product.delete');
        Route::get('/product/edit/{product_id?}/{product_slug?}', [ProductController::class, 'edit_product'])->name('admin.product.edit');
        Route::put('/product/update/{product_id}', [ProductController::class, 'update_product'])->name('admin.product.update');
        Route::put('/product/update/image/{product_id}', [ProductController::class, 'update_product_image'])->name('admin.product.image.update');
        Route::put('/product/update/video/{product_id}', [ProductController::class, 'update_product_video'])->name('admin.product.video.update');
        Route::put('/product/image/delete/{product_id}/{image_name}', [ProductController::class, 'product_image_delete'])->name('admin.product.image.delete');
        Route::put('/product/video/delete/{product_id}/{video_name}', [ProductController::class, 'product_video_delete'])->name('admin.product.video.delete');

        //################# Audios #################
        Route::get('/audios', [AudioController::class, 'audios_list'])->name('admin.audios.list');
        Route::get('/audio/create', [AudioController::class, 'audio_create'])->name('admin.audio.create');
        Route::post('/audio/store', [AudioController::class, 'audio_store'])->name('admin.audio.store');
        Route::get('/audio/view/{audio_id}', [AudioController::class, 'view_audio'])->name('admin.audio.view');
        Route::get('/audio/edit/{audio_id}', [AudioController::class, 'edit_audio'])->name('admin.audio.edit');
        Route::put('/audio/update/{audio_id}', [AudioController::class, 'update_audio'])->name('admin.audio.update');
        Route::delete('/audio/delete/{audio_id}', [AudioController::class, 'delete_audio'])->name('admin.audio.delete');

        //#################### Ebooks ####################
        Route::get('/ebooks', [EbookController::class, 'ebooks_list'])->name('admin.ebooks.list');
        Route::get('/ebook/create', [EbookController::class, 'ebook_create'])->name('admin.ebook.create');
        Route::post('/ebook/store', [EbookController::class, 'ebook_store'])->name('admin.ebook.store');
        Route::get('/ebook/view/{ebook_id}', [EbookController::class, 'view_ebook'])->name('admin.ebook.view');
        Route::get('/ebook/edit/{ebook_id}', [EbookController::class, 'edit_ebook'])->name('admin.ebook.edit');
        Route::put('/ebook/update/{ebook_id}', [EbookController::class, 'update_ebook'])->name('admin.ebook.update');
        Route::delete('/ebook/delete/{ebook_id}', [EbookController::class, 'delete_ebook'])->name('admin.ebook.delete');

        //#################### Coupons ####################
        Route::get('/coupons', [CouponController::class, 'coupons_list'])->name('admin.coupons.list');
        Route::get('/coupon/add', [CouponController::class, 'coupon_add'])->name('admin.coupon.add');
        Route::post('/coupon/add/submit', [CouponController::class, 'coupon_add_submit'])->name('admin.coupon.add.submit');
        Route::get('/coupon/view/{coupon_id?}/{coupon_slug?}', [CouponController::class, 'view_coupon'])->name('admin.coupon.view');
        Route::get('/coupon/edit/{coupon_id?}/{coupon_slug?}', [CouponController::class, 'edit_coupon'])->name('admin.coupon.edit');
        Route::put('/coupon/update/{coupon_id}', [CouponController::class, 'update_coupon'])->name('admin.coupon.update');
        Route::get('/coupon/delete/{coupon_id}', [CouponController::class, 'delete_coupon'])->name('admin.coupon.delete');

        //################# Wishlist #################
        Route::get('/wishlists', [WishlistController::class, 'wishlists_list'])->name('admin.wishlists.list');
        Route::get('/wishlist/view/{user_id}', [WishlistController::class, 'wishlist_view'])->name('admin.wishlist.view');

        //################# Cart #################
        Route::get('/carts', [CartController::class, 'carts_list'])->name('admin.carts.list');
        Route::get('/cart/{ip_address}/view/products', [CartController::class, 'cart_products_view'])->name('admin.cart.view.products');
        Route::get('/cart/delete/if_expires', [CartController::class, 'cart_delete_if_expired'])->name('admin.cart.delete.on.expiry');

        //################# Orders #################
        Route::get('/orders', [OrderController::class, 'orders_list'])->name('admin.orders.list');
        Route::patch('/order/seen_by_admin/to/yes', [OrderController::class, 'seen_by_admin_to_yes'])->name('admin.order.seen_by_admin.to.yes');
        Route::patch('/order/seen_by_admin/to/no', [OrderController::class, 'seen_by_admin_to_no'])->name('admin.order.seen_by_admin.to.no');
        Route::patch('/order/out_for_delivery/to/yes', [OrderController::class, 'out_for_delivery_to_yes'])->name('admin.order.out_for_delivery.to.yes');
        Route::patch('/order/out_for_delivery/to/no', [OrderController::class, 'out_for_delivery_to_no'])->name('admin.order.out_for_delivery.to.no');
        Route::patch('/order/completed/to/yes', [OrderController::class, 'completed_to_yes'])->name('admin.order.completed.to.yes');
        Route::patch('/order/completed/to/no', [OrderController::class, 'completed_to_no'])->name('admin.order.completed.to.no');
        Route::get('/order/delete/{order_id}', [OrderController::class, 'order_delete'])->name('admin.order.delete');
        Route::get('/order/details/view/{order_id}', [OrderController::class, 'admin_view_order_details'])->name('admin.order.details.view');
        Route::get('/order/{order_id}/invoice/view/', [OrderController::class, 'admin_view_order_invoice'])->name('admin.order.invoice.view');
        Route::get('/order/{order_id}/invoice/generate/', [OrderController::class, 'admin_generate_order_invoice'])->name('admin.order.invoice.generate');
        Route::put('/create/auth/plus/mail', [AuthController::class, 'create_auth_plus_mail'])->name('admin.create.auth.plus.mail');

        //################# Product Reviews #################
        Route::get('/reviews', [ReviewController::class, 'reviews_list'])->name('admin.reviews.list');
        Route::get('/review/edit/{review_id}', [ReviewController::class, 'admin_review_edit'])->name('admin.review.edit');
        Route::put('/review/update/{review_id}', [ReviewController::class, 'admin_review_update'])->name('admin.review.update');
        Route::get('/review/view/{review_id}', [ReviewController::class, 'admin_review_view'])->name('admin.review.view');
        Route::get('/review/delete/{review_id}', [ReviewController::class, 'admin_review_delete'])->name('admin.review.delete');

        //################# Courier #################
        Route::get('/couriers', [CourierController::class, 'couriers_list'])->name('admin.couriers.list');
        Route::get('/courier/form', [CourierController::class, 'courier_form'])->name('admin.courier.form');
        Route::post('/courier/form/submit', [CourierController::class, 'courier_form_submit'])->name('admin.courier.form.submit');

        //################# Feedback #################
        Route::get('/feedbacks', [FeedbackController::class, 'feedbacks_list'])->name('admin.feedbacks.list');
        Route::get('/feedback/view/{feedback_id}', [FeedbackController::class, 'feedback_view'])->name('admin.feedback.view');
        Route::get('/feedback/edit/{feedback_id}', [FeedbackController::class, 'feedback_edit'])->name('admin.feedback.edit');
        Route::put('/feedback/update/{feedback_id}', [FeedbackController::class, 'feedback_update'])->name('admin.feedback.update');
        Route::get('/feedback/delete/{feedback_id}', [FeedbackController::class, 'feedback_delete'])->name('admin.feedback.delete');

        //################# Newsletter Subscription #################
        Route::get('/subscription/emails', [FeedbackController::class, 'subscription_emails'])->name('admin.subscription.emails');

        //################# Report #################
        Route::get('/report/orders', [ReportController::class, 'orders_report'])->name('admin.report.orders');
        Route::get('/report/orders/search', [ReportController::class, 'orders_report_search'])->name('admin.report.orders.search');

        //################# Blog Tag #################
        Route::resource('/tag', TagController::class);
        Route::get('/tag/destroy/{tag_id}', [TagController::class, 'destroy'])->name('tag.delete');

        //################# Blog Post #################
        Route::get('/post/index', [PostController::class, 'index'])->name('admin.post.index');
        Route::get('/post/create', [PostController::class, 'create'])->name('admin.post.create');
        Route::post('/post/store', [PostController::class, 'store'])->name('admin.post.store');
        Route::get('/post/show/{post_id}', [PostController::class, 'show'])->name('admin.post.show');
        Route::get('/post/edit/{post_id}', [PostController::class, 'edit'])->name('admin.post.edit');
        Route::put('/post/update/{post_id}', [PostController::class, 'update'])->name('admin.post.update');
        Route::get('/post/destroy/{post_id}', [PostController::class, 'destroy'])->name('admin.post.destroy');
    });
});
