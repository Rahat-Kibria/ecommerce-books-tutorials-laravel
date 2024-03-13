<footer class="site-footer" style="background: #E5E6EB;">
    <div class="container pt--40">
        <div class="row justify-content-between  section-padding">
            <div class=" col-xl-3 col-lg-4 col-sm-6">
                <div class="single-footer pb--40">
                    <div class="brand-footer footer-title">
                        <img src="{{ url('/frontend/image/books-tutorials-logo.png') }}" style="width: 181px; height:39px"
                            alt="My Website Logo">
                    </div>
                    <div class="footer-contact">
                        <p><span class="label">Address:</span><span>Uttara, Dhaka</span></p>
                        <p><span class="label">Phone:</span><span class="text">+880 12345-67890</span></p>
                        <p><span class="label">Email:</span><span class="text">suport@botu.com</span></p>
                    </div>
                </div>
            </div>
            <div class=" col-xl-3 col-lg-2 col-sm-6">
                <div class="single-footer pb--40">
                    <div class="footer-title">
                        <h3>Customer Care</h3>
                    </div>
                    <ul class="footer-list normal-list">
                        <li><a href="{{ url('') }}">Help Center</a></li>
                        <li><a href="{{ url('') }}">How to Buy</a></li>
                        <li><a href="{{ url('') }}">Returns and Refunds</a></li>
                        <li><a href="{{ route('botu.faq') }}">FAQ</a></li>
                        <li><a href="{{ route('botu.contact') }}">Contact Us</a></li>
                        <li><a href="{{ route('botu.terms_and_conditions') }}">Terms & Conditions</a></li>
                    </ul>
                </div>
            </div>
            <div class=" col-xl-3 col-lg-2 col-sm-6">
                <div class="single-footer pb--40">
                    <div class="footer-title">
                        <h3>Botu</h3>
                    </div>
                    <ul class="footer-list normal-list">
                        <li><a href="{{ url('') }}">About Botu</a></li>
                        <li><a href="{{ url('') }}">Digital Payments</a></li>
                        <li><a href="{{ route('botu.blog.home') }}">Botu Blog</a></li>
                        <li><a href="{{ url('') }}">Botu App</a></li>
                        <li><a href="{{ url('') }}">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class=" col-xl-3 col-lg-4 col-sm-6">
                <div class="footer-title">
                    <h3>Newsletter Subscribe</h3>
                </div>
                <div class="newsletter-form mb--30">
                    <form action="{{ route('botu.subscribe.newsletter') }}" method="post">
                        @csrf
                        <input type="email" name="email" class="form-control"
                            placeholder="Enter Your Email Address Here...">
                        @if ($errors->has('email'))
                            @foreach ($errors->get('email') as $error)
                                <small class="text-danger">{{ $error }}</small>
                            @endforeach
                        @endif
                        <button type="submit" class="btn btn--primary w-100">Subscribe</button>
                    </form>
                </div>
                <div class="social-block">
                    <h3 class="title">STAY CONNECTED</h3>
                    <ul class="social-list list-inline">
                        <li class="single-social facebook"><a href="https://www.facebook.com/wahy100" target="_blank"><i
                                    class="ion ion-social-facebook"></i></a>
                        </li>
                        <li class="single-social twitter"><a href="https://twitter.com/rahatkibria1" target="_blank"><i
                                    class="ion ion-social-twitter"></i></a>
                        </li>
                        <li class="single-social youtube"><a href="https://www.youtube.com/@wahy100" target="_blank"><i
                                    class="ion ion-social-youtube"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <p class="copyright-heading">Botu.com is now one of the leading e-commerce organizations in Bangladesh. It
                is indeed one of the biggest online books and tutorials shop in Bangladesh that helps you save time and
                money. You can buy books and tutorials online with a few clicks or a convenient phone call. With
                breathtaking discounts and offers you can buy anything from Islamic, Computer Science and language
                learning books and tutorials. Superfast cash on delivery service brings the products at
                your doorstep. Our customer support, return and replacement policies will surely add extra confidence in
                your online shopping experience. Happy Shopping with Botu.com!</p>
            <p class="copyright-text">Copyright © 2022 <a href="{{ url('') }}" class="author">Botu</a>. All
                Right Reserved. <br> Design By Botu Shop
            </p>
        </div>
    </div>
</footer>
