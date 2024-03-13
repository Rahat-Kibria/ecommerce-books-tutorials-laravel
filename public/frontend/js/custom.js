jQuery(document).ready(function (n) {
    !(function (I) {
        "use strict";
        var s = I(".off-canvas-nav");
        (i = s.find(".sub-menu"))
            .parent()
            .prepend(
                '<span class="menu-expand"><i class="fas fa-chevron-down"></i></span>'
            ),
            i.slideUp(),
            s.on("click", "li a, li .menu-expand", function (s) {
                var e = I(this);
                e
                    .parent()
                    .attr("class")
                    .match(
                        /\b(menu-item-has-children|has-children|has-sub-menu)\b/
                    ) &&
                    ("#" === e.attr("href") || e.hasClass("menu-expand")) &&
                    (s.preventDefault(),
                        e.siblings("ul:visible").length
                            ? (e.parent("li").removeClass("active"),
                                e.siblings("ul").slideUp())
                            : (e.parent("li").addClass("active"),
                                e
                                    .closest("li")
                                    .siblings("li")
                                    .find("ul:visible")
                                    .slideUp(),
                                e.siblings("ul").slideDown()));
            }),
            I(".off-canvas-btn").on("click", function () {
                I(".off-canvas-wrapper").addClass("open");
            }),
            I(".btn-close-off-canvas").on("click", function () {
                I(".off-canvas-wrapper").removeClass("open");
            }),
            I(".hidden-menu-item").css("display", "none"),
            I(window).on({
                load: function () {
                    I(window).width() <= 1200 &&
                        I(".hidden-lg-menu-item").css("display", "none");
                },
                resize: function () {
                    I(window).width() <= 1200 &&
                        I(".hidden-lg-menu-item").css("display", "none");
                },
            }),
            I(".js-expand-hidden-menu").on("click", function (s) {
                s.preventDefault(),
                    I(".hidden-menu-item").toggle(500),
                    I(window).width() <= 1200 &&
                    I(".hidden-lg-menu-item").toggle(500);
                s = "Close Categories";
                I(this).html(I(this).text() == s ? "More Categories" : s),
                    I(this).toggleClass("menu-close");
            }),
            I(".category-menu .has-children > a").on("click", function (s) {
                s.preventDefault(),
                    I(this).siblings(".sub-menu").slideToggle("500");
            }),
            I(".search-trigger").on("click", function () {
                I(".search-wrapper").addClass("open");
            }),
            I(".search-dismiss,body").on("click", function (s) {
                I(".search-wrapper").removeClass("open");
            }),
            I(".search-box,.search-trigger").on("click", function (s) {
                s.stopPropagation();
            }),
            I(".category-trigger").on("click", function (s) {
                I(".category-nav").toggleClass("show"), s.stopPropagation();
            });
        var e,
            O = I("html"),
            P = I("body"),
            i = I(".sb-slick-slider"),
            s = I(".sb-slick-slider-2");
        ("rtl" != O.attr("dir") && "rtl" != P.attr("dir")) ||
            i.attr("dir", "rtl"),
            ("rtl" != O.attr("dir") && "rtl" != P.attr("dir")) ||
            s.attr("dir", "rtl"),
            i.each(function () {
                for (
                    var s = I(this),
                    e = s.data("slick-setting")
                        ? s.data("slick-setting")
                        : "",
                    i = e.autoplay || !1,
                    t = parseInt(e.autoplaySpeed, 10) || 2e3,
                    a = e.asNavFor || null,
                    n = e.appendArrows || s,
                    l = e.appendDots || s,
                    o = e.arrows || !1,
                    r = e.prevArrow
                        ? '<button class="' +
                        (e.prevArrow.buttonClass || "slick-prev") +
                        '"><i class="' +
                        e.prevArrow.iconClass +
                        '"></i></button>'
                        : '<button class="slick-prev">previous</button>',
                    d = e.nextArrow
                        ? '<button class="' +
                        (e.nextArrow.buttonClass || "slick-next") +
                        '"><i class="' +
                        e.nextArrow.iconClass +
                        '"></i></button>'
                        : '<button class="slick-next">next</button>',
                    c = e.centerMode || !1,
                    p = e.centerPadding || "50px",
                    u = e.dots || !1,
                    v = e.fade || !1,
                    h = e.focusOnSelect || !1,
                    g = e.infinite || !1,
                    w = e.pauseOnHover || !1,
                    m = parseInt(e.rows, 10) || 1,
                    f = parseInt(e.slidesToShow, 10) || 1,
                    b = parseInt(e.slidesToScroll, 10) || 1,
                    k = e.swipe || !0,
                    C = e.swipeToSlide || !1,
                    y = e.variableWidth || !1,
                    x = e.vertical || !1,
                    S = e.verticalSwiping || !1,
                    e = !!(
                        e.rtl ||
                        O.attr('dir="rtl"') ||
                        P.attr('dir="rtl"')
                    ),
                    A =
                        void 0 !== s.data("slick-responsive")
                            ? s.data("slick-responsive")
                            : "",
                    _ = A.length,
                    T = [],
                    D = 0;
                    D < _;
                    D++
                )
                    T[D] = A[D];
                s.slick({
                    autoplay: i,
                    autoplaySpeed: t,
                    asNavFor: a,
                    appendArrows: n,
                    appendDots: l,
                    arrows: o,
                    dots: u,
                    centerMode: c,
                    centerPadding: p,
                    fade: v,
                    focusOnSelect: h,
                    infinite: g,
                    pauseOnHover: w,
                    rows: m,
                    slidesToShow: f,
                    slidesToScroll: b,
                    swipe: k,
                    swipeToSlide: C,
                    variableWidth: y,
                    vertical: x,
                    verticalSwiping: S,
                    rtl: e,
                    prevArrow: r,
                    nextArrow: d,
                    responsive: T,
                });
            }),
            s.each(function () {
                for (
                    var s = I(this),
                    e = s.data("slick-setting")
                        ? s.data("slick-setting")
                        : "",
                    i = e.autoplay || !1,
                    t = parseInt(e.autoplaySpeed, 10) || 2e3,
                    a = e.asNavFor || null,
                    n = e.appendArrows || s,
                    l = e.appendDots || s,
                    o = e.arrows || !1,
                    r = e.prevArrow
                        ? '<button class="' +
                        (e.prevArrow.buttonClass || "slick-prev") +
                        '"><i class="' +
                        e.prevArrow.iconClass +
                        '"></i></button>'
                        : '<button class="slick-prev">previous</button>',
                    d = e.nextArrow
                        ? '<button class="' +
                        (e.nextArrow.buttonClass || "slick-next") +
                        '"><i class="' +
                        e.nextArrow.iconClass +
                        '"></i></button>'
                        : '<button class="slick-next">next</button>',
                    c = e.centerMode || !1,
                    p = e.centerPadding || "50px",
                    u = e.dots || !1,
                    v = e.fade || !1,
                    h = e.focusOnSelect || !1,
                    g = e.infinite || !1,
                    w = e.pauseOnHover || !1,
                    m = parseInt(e.rows, 10) || 1,
                    f = parseInt(e.slidesToShow, 10) || 1,
                    b = parseInt(e.slidesToScroll, 10) || 1,
                    k = e.swipe || !0,
                    C = e.swipeToSlide || !1,
                    y = e.variableWidth || !1,
                    x = e.vertical || !0,
                    S = e.verticalSwiping || !0,
                    e = !!(
                        e.rtl ||
                        O.attr('dir="rtl"') ||
                        P.attr('dir="rtl"')
                    ),
                    A =
                        void 0 !== s.data("slick-responsive")
                            ? s.data("slick-responsive")
                            : "",
                    _ = A.length,
                    T = [],
                    D = 0;
                    D < _;
                    D++
                )
                    T[D] = A[D];
                s.slick({
                    autoplay: i,
                    autoplaySpeed: t,
                    asNavFor: a,
                    appendArrows: n,
                    appendDots: l,
                    arrows: o,
                    dots: u,
                    centerMode: c,
                    centerPadding: p,
                    fade: v,
                    focusOnSelect: h,
                    infinite: g,
                    pauseOnHover: w,
                    rows: m,
                    slidesToShow: f,
                    slidesToScroll: b,
                    swipe: k,
                    swipeToSlide: C,
                    variableWidth: y,
                    vertical: x,
                    verticalSwiping: S,
                    rtl: e,
                    prevArrow: r,
                    nextArrow: d,
                    responsive: T,
                });
            }),
            I(".slide-down--btn").on("click", function (s) {
                s.stopPropagation(),
                    I(this).siblings(".slide-down--item").slideToggle("400"),
                    I(this).siblings(".slide-down--item").toggleClass("show");
                I(this)
                    .parents(".slide-wrapper")
                    .siblings()
                    .children(".slide-down--item");
                I(this)
                    .parents(".slide-wrapper")
                    .siblings()
                    .children(".slide-down--item")
                    .slideUp("400");
            }),
            I("body").on("click", function (s) {
                I(".slide-down--item").slideUp("500");
            }),
            I(".slide-down--item").on("click", function (s) {
                s.stopPropagation();
            }),
            (e = I(".site-header")[0].getBoundingClientRect().height),
            I(window).on({
                resize: function () {
                    I(window).width() <= 991
                        ? (I(".sticky-init").removeClass("fixed-header"),
                            I(".sticky-init").hasClass("sticky-header") &&
                            I(".sticky-init").removeClass("sticky-header"))
                        : I(".sticky-init").addClass("fixed-header");
                },
                load: function () {
                    I(window).width() <= 991
                        ? (I(".sticky-init").removeClass("fixed-header"),
                            I(".sticky-init").hasClass("sticky-header") &&
                            I(".sticky-init").removeClass("sticky-header"))
                        : I(".sticky-init").addClass("fixed-header");
                },
            }),
            I(window).on("scroll", function () {
                I(window).scrollTop() >= e
                    ? I(".fixed-header").addClass("sticky-header")
                    : I(".fixed-header").removeClass("sticky-header");
            }),
            I(function () {
                I(".sb-range-slider").slider({
                    range: !0,
                    min: 0,
                    max: 1e4,
                    values: [0, 1e4],
                    slide: function (s, e) {
                        I("#amount").val(
                            "৳" + e.values[0] + " - ৳" + e.values[1]
                        ),
                            I("#min_amount").val(e.values[0]),
                            I("#max_amount").val(e.values[1]);
                    },
                });
                I("#amount").val(
                    "৳" +
                    I(".sb-range-slider").slider("values", 0) +
                    " - ৳" +
                    I(".sb-range-slider").slider("values", 1)
                ),
                    I("#min_amount").val(
                        I(".sb-range-slider").slider("values", 0)
                    ),
                    I("#max_amount").val(
                        I(".sb-range-slider").slider("values", 1)
                    );
            }),
            I(".product-view-mode a").on("click", function (s) {
                s.preventDefault();
                var e = I(".shop-product-wrap"),
                    s = I(this).data("target");
                I(".product-view-mode a").removeClass("active"),
                    I(this).addClass("active"),
                    e.removeClass("grid list").addClass(s),
                    e.hasClass("grid")
                        ? I(".pm-product").removeClass("product-type-list")
                        : I(".pm-product").addClass("product-type-list");
            }),
            I(".count-btn").on("click", function () {
                var s = I(this),
                    e = s
                        .parent(".count-input-btns")
                        .parent()
                        .find("input")
                        .val();
                (e = s.hasClass("inc-ammount")
                    ? parseFloat(e) + 1
                    : 0 < e
                        ? parseFloat(e) - 1
                        : 0),
                    s.parent(".count-input-btns").parent().find("input").val(e);
            }),
            I("[data-shipping]").on("click", function () {
                0 < I("[data-shipping]:checked").length
                    ? I("#shipping-form").slideDown()
                    : I("#shipping-form").slideUp();
            }),
            I(".add-to-cart").on("click", function (s) {
                s.preventDefault(),
                    I(this).hasClass("added")
                        ? I(this)
                            .removeClass("added")
                            .find("i")
                            .removeClass("ti-check")
                            .addClass("ti-shopping-cart")
                            .siblings("span")
                            .text("add to cart")
                        : I(this)
                            .addClass("added")
                            .find("i")
                            .addClass("ti-check")
                            .removeClass("ti-shopping-cart")
                            .siblings("span")
                            .text("added");
            }),
            I(".bg-image").each(function () {
                var s = I(this),
                    e = s.data("bg");
                s.css({ "background-image": "url(" + e + ")" });
            }),
            I(".nice-select").niceSelect(),
            I(".product-view-mode a").on("click", function (s) {
                s.preventDefault();
                var e = I(".shop-product-wrap"),
                    s = I(this).data("target");
                I(".product-view-mode a").removeClass("active"),
                    I(this).addClass("active"),
                    e.removeClass("grid list grid-four").addClass(s),
                    e.hasClass("grid") || e.hasClass("grid-four")
                        ? I(".product-card").removeClass("card-style-list")
                        : I(".product-card").addClass("card-style-list");
            }),
            I('[name="payment-method"]').on("click", function () {
                var s = I(this).attr("value");
                I(".single-method p").slideUp(),
                    I('[data-method="' + s + '"]').slideDown();
            }),
            I(".slide-trigger").on("click", function () {
                var s = I(this).data("target");
                I(s).slideToggle();
            }),
            I.scrollUp({
                scrollText:
                    '<i class="ion-chevron-right"></i><i class="ion-chevron-right"></i>',
                easingType: "linear",
                scrollSpeed: 900,
            });
    })(jQuery),
        n("#mc-form").ajaxChimp({
            language: "en",
            callback: function (s) {
                "success" === s.result
                    ? (n(".mailchimp-success")
                        .html("" + s.msg)
                        .fadeIn(900),
                        n(".mailchimp-error").fadeOut(400))
                    : "error" === s.result &&
                    n(".mailchimp-error")
                        .html("" + s.msg)
                        .fadeIn(900);
            },
            url: "http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef",
        }),
        n("[data-countdown]").each(function () {
            var e = n(this),
                s = n(this).data("countdown");
            e.countdown(s, function (s) {
                e.html(
                    s.strftime(
                        '<div class="single-countdown"><span class="single-countdown__time">%D</span><span class="single-countdown__text">Days</span></div><div class="single-countdown"><span class="single-countdown__time">%H</span><span class="single-countdown__text">Hours</span></div><div class="single-countdown"><span class="single-countdown__time">%M</span><span class="single-countdown__text">mins</span></div><div class="single-countdown"><span class="single-countdown__time">%S</span><span class="single-countdown__text">Secs</span></div>'
                    )
                );
            });
        }),
        n(".color-list a").on("click", function (s) {
            s.preventDefault();
            s = n(this);
            s.addClass("active"), s.siblings().removeClass("active");
            for (
                var e = document.querySelectorAll("#product-nav .single-slide"),
                i = document.querySelectorAll(
                    "#products-details .single-slide"
                ),
                t = s.data("swatch-color"),
                a = 0;
                a < e.length;
                a++
            )
                e[a].classList.remove("slick-current"),
                    e[a].classList.contains(t) &&
                    e[a].classList.add("slick-current");
            for (a = 0; a < i.length; a++)
                i[a].classList.remove("slick-current"),
                    (i[a].style.opacity = 0),
                    i[a].classList.contains(t) &&
                    (i[a].classList.add("slick-current"),
                        (i[a].style.opacity = 1));
        });
});
