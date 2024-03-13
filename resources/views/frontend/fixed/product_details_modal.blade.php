<Style>
    .swiper {
        width: 100%;
        height: 100%;
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .mySwiper2 {
        height: 80%;
        width: 100%;
    }

    .mySwiper {
        height: 20%;
        box-sizing: border-box;
        padding: 10px 0;
    }

    .mySwiper .swiper-slide {
        width: 25%;
        height: 100%;
        opacity: 0.4;
    }

    .mySwiper .swiper-slide-thumb-active {
        opacity: 1;
    }
</Style>
<div class="modal fade modal-quick-view" id="productDetailsIslamicModal" tabindex="-1" role="dialog"
    aria-labelledby="quickModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close modal-close-btn ml-auto" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="product-details-modal" id="pass_data">
                <div class="row">
                    <div class="col-lg-5">
                        <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                            class="swiper mySwiper2">
                            <div class="swiper-wrapper" id="product-image">
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                        <div thumbsSlider="" class="swiper mySwiper">
                            <div class="swiper-wrapper" id="product-image-bottom">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 mt--30 mt-lg--30">
                        <div class="product-details-info pl-lg--30 ">
                            <p class="tag-block">Tags: <a href="#">Category1</a>, <a href="#">Category2</a>
                            </p>
                            <h3 class="product-title" id="product-title"></h3>
                            <ul class="list-unstyled">
                                <li>Author: <a href="#" class="list-value font-weight-bold"
                                        id="product-author"></a>
                                </li>
                                <li>Stock: <span class="list-value" id="product-stock-status"></span></li>
                            </ul>
                            <div class="price-block">
                                <span class="price-new" id="product-price-new"></span>
                                <del class="price-old" id="product-price-old"></del>
                            </div>
                            <div class="rating-widget">
                                <div class="rating-block">
                                    <span class="fas fa-star star_on"></span>
                                    <span class="fas fa-star star_on"></span>
                                    <span class="fas fa-star star_on"></span>
                                    <span class="fas fa-star star_on"></span>
                                    <span class="fas fa-star "></span>
                                </div>
                                <div class="review-widget">
                                    <a href="#">(1 Reviews)</a> <span>|</span>
                                    <a href="#">Write a review</a>
                                </div>
                            </div>
                            <article class="product-details-article">
                                <h4 class="sr-only">Product Summery</h4>
                                <p id="product-short-description"></p>
                            </article>
                            <form action="" method="post" id="cart-form-submit">
                                @csrf
                                @method('put')
                                <div class="add-to-cart-row">
                                    <div class="count-input-block">
                                        <span class="widget-label">Qty</span>
                                        <input type="number" name="quantity" class="form-control text-center"
                                            value="1">
                                    </div>
                                    <div class="add-cart-btn">
                                        <button type="submit" class="btn btn-outlined--primary">
                                            <span class="plus-icon">+</span>Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="compare-wishlist-row">
                                <form action="" method="post" id="wishlist-form-submit">
                                    @csrf
                                    <button type="submit" class="add-link"><i class="fas fa-heart"></i>Add to Wish
                                        List</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="widget-social-share">
                    <span class="widget-label">Share:</span>
                    <div class="modal-social-share">
                        <a href="#" class="single-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="single-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="single-icon"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
