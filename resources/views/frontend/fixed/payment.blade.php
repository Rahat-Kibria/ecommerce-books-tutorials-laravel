<section class="section-margin">
    <div class="section-title section-title--bordered mb-lg--60">
        <h2>Payment Methods</h2>
    </div>
    <h2 class="sr-only">Slider</h2>
    <div class="container">
        <div class="brand-slider sb-slick-slider border-top border-bottom"
            data-slick-setting='{
                                    "autoplay": true,
                                    "autoplaySpeed": 8000,
                                    "slidesToShow": 6
                                }'
            data-slick-responsive='[
                {"breakpoint":992, "settings": {"slidesToShow": 4} },
                {"breakpoint":768, "settings": {"slidesToShow": 3} },
                {"breakpoint":575, "settings": {"slidesToShow": 3} },
                {"breakpoint":480, "settings": {"slidesToShow": 2} },
                {"breakpoint":320, "settings": {"slidesToShow": 1} }
        ]'>
            <div class="single-slide">
                <img class="cod" src="{{ url('/frontend/image/icon/cod.png') }}" alt="CashOnDelivery"
                    title="Cash On Delivery">
            </div>
            <div class="single-slide">
                <img class="bKash" src="{{ url('/frontend/image/icon/bkash.png') }}" alt="bKash" title="bKash">
            </div>
            <div class="single-slide">
                <img class="nagad" src="{{ url('/frontend/image/icon/nagad.png') }}" alt="nagad" title="Nagad">
            </div>
            <div class="single-slide">
                <img class="rocket" src="{{ url('/frontend/image/icon/rocket.png') }}" alt="Rocket" title="Rocket">
            </div>
            <div class="single-slide">
                <img class="visa" src="{{ url('/frontend/image/icon/visa.png') }}" alt="Visa" title="Visa">
            </div>
            <div class="single-slide">
                <img class="master-card" src="{{ url('/frontend/image/icon/master-card.png') }}" alt="Master Card"
                    title="Master Card">
            </div>
        </div>
    </div>
</section>
