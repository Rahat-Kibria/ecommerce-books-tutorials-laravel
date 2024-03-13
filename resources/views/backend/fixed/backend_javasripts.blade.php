<script src="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js') }}"
    crossorigin="anonymous"></script>
<script src="{{ url('/backend/js/scripts.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
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

        // ckeditor text editor
        ClassicEditor
            .create(document.querySelector('#ck_editor'))
            .catch(error => {
                // console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#ck_editor1'))
            .catch(error => {
                // console.error(error);
            });

        // product image change using swiper slider
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

        // print div for order report
        $(document).on('click', '#report_print_button', function() {
            var printContents = document.getElementById('ordersReport').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        });

    });
</script>
