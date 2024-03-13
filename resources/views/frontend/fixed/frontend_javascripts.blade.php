{{-- Use Minified Plugins Version For Fast Page Load --}}
<script src="{{ url('/frontend/js/plugins.js') }}"></script>
<script src="{{ url('/frontend/js/ajax-mail.js') }}"></script>
<script src="{{ url('/frontend/js/custom.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
{{-- Swiper JS --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function() {
        // Password show using fontawesome eye icon
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("fa-eye-slash");
                $('#show_hide_password i').removeClass("fa-eye");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("fa-eye-slash");
                $('#show_hide_password i').addClass("fa-eye");
            }
        });

        // To make ul li a clickable
        $('li.cat-item').css('cursor', 'pointer')
            .click(function() {
                window.location = $('a', this).attr('href');
                return false;
            });

        // Toastr messages
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @elseif (Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
        @elseif (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @elseif (Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
        @endif

        // Mobile Dropdown Menu
        /* When the user clicks on the button, toggle between hiding and showing the dropdown content */
        function dropdown_toggle() {
            document.getElementById("dropdown_menu").classList.toggle("show_menu");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropdown_toggle')) {
                var dropdowns = document.getElementsByClassName("dropdown_menu");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show_menu')) {
                        openDropdown.classList.remove('show_menu');
                    }
                }
            }
        }

        // ################# AUTOCOMPLETE BIG SCREEN ####################
        $("input[id='search_input']").on("keyup", function() {
            let input_value = $(this).val();
            if (input_value != "") {
                $.ajax({
                    url: "{{ route('botu.search.products.ajax') }}",
                    method: "GET",
                    data: {
                        "name": input_value
                    },
                    success: function(response) {
                        $("#product-list-search").html(response);
                    }
                });
            } else {
                return false;
            }
        });
        $("div[id='product-list-search']").on("click", "li", function() {
            let select_text = $(this).text();
            $("input[id='search_input']").val(select_text);
            $("#product-list-search").html("");
        });
        $(document).on("click", function() {
            $("#product-list-search").html("");
        });

        // ################# AUTOCOMPLETE MOBILE ####################
        $("input[id='search_input_mobile']").on("keyup", function() {
            let input_value = $(this).val();
            if (input_value != "") {
                $.ajax({
                    url: "{{ route('botu.search.products.ajax') }}",
                    method: "GET",
                    data: {
                        "name": input_value
                    },
                    success: function(response) {
                        $("#product-list-search-mobile").html(response);
                        $("#product-list-search li:first").addClass("autocomplete-active");
                    }
                });
            } else {
                return false;
            }
        });
        $("div[id='product-list-search-mobile']").on("click", "li", function() {
            let select_text = $(this).text();
            $("input[id='search_input_mobile']").val(select_text);
            $("#product-list-search-mobile").html("");
        });
        $(document).on("click", function() {
            $("#product-list-search-mobile").html("");
        });

        // modal image slider
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });
        var swiper2 = new Swiper(".mySwiper2", {
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });

        // product details modal view
        $(document).on('click', '.product_details_modal', function() {
            let id = $(this).data('id');
            let image = $(this).data('image');
            let name = $(this).data('name');
            let author = $(this).data('author');
            let stock_status = $(this).data('stock-status');
            let price = $(this).data('price');
            let discount = $(this).data('discount');
            let price_new = price - (price * discount) / 100;
            let short_description = $(this).data('short-description');
            let text = "";
            image.forEach(productImage);

            function productImage(item, index) {
                text += "<div class='swiper-slide'><img src='{{ asset('/uploads/product_images/') }}/" +
                    item +
                    "' alt='product image'></div>";
            }

            $('#productDetailsIslamicModal').modal('show');
            $('#product-image').html(text);
            $('#product-image-bottom').html(text);
            $('#product-title').text(name);
            $('#product-author').text(author);
            $('#product-stock-status').text(stock_status);
            $('#product-price-new').text('৳' + price_new);
            $('#product-price-old').text('৳' + price);
            $('#product-short-description').html(short_description);
            $('#cart-form-submit').attr('action', "{{ route('botu.cart.update.single') }}/" + id);
            $('#wishlist-form-submit').attr('action', "{{ route('botu.add_to_wishlist') }}/" + id);
        });

        // my reviews ratings navbar show hide child links
        $(document).on('click', '#my_reviews', function() {
            $('.list-group.collapse').toggle(500);
        });

        // Smooth jump/scroll to div id in the same page in product details page
        $("#write_review_from, #write_review_from2").click(function() {
            $('html, body').animate({
                scrollTop: $("#write_review_to").offset().top
            }, 1000);
        });
        $("#write_review_from3, #write_review_from4").click(function() {
            $('html, body').animate({
                scrollTop: $("#write_review_to").offset().top
            }, 1000);
        });

        // Smooth jump/scroll to div id in the same page in blog page
        $("#blog_comment_from").click(function() {
            $('html, body').animate({
                scrollTop: $("#blog_comment_to").offset().top
            }, 1000);
        });

        // submit form on product sorting options
        $('#sort_by').on('change', function() {
            this.form.submit();
        });

        // submit form on showing number of products per page
        $('#show_products').on('change', function() {
            this.form.submit();
        });

    });
</script>
