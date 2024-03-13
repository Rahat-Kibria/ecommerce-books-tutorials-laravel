@extends('frontend.customer')
@section('content')
    <section class="breadcrumb-section">
        <h2 class="sr-only">Site Breadcrumb</h2>
        <div class="container">
            <div class="breadcrumb-contents">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('botu') }}">Home</a></li>
                        <li class="breadcrumb-item active">FAQ</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    {{-- faq Page Start --}}
    <div class="faq-area inner-page-sec-padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner text-center">
                        <h1>GENERAL QUESTIONS</h1>
                    </div>
                </div>
            </div>
            <div class="row mbn-30">

                <div class="col-lg-6 col-12">
                    {{-- FAQ (Accordion) Start --}}
                    <div class="accordion" id="gq-faqs-1">

                        {{-- Card Start --}}
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0"><button class="collapsed" data-toggle="collapse"
                                        data-target="#gq-faq-1">What is the guest order ?</button>
                                </h5>
                            </div>
                            <div id="gq-faq-1" class="collapse show" data-parent="#gq-faqs-1">
                                <div class="card-body">
                                    <p>Orders can be made without registration/login on Rockmari's site in the same process.
                                        But in this case order cannot be tracked, points benefit will not be available. This
                                        is considered as a guest order.
                                    </p>
                                </div>
                            </div>
                        </div>{{-- Card End --}}

                        {{-- Card Start --}}
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0"><button class="collapsed" data-toggle="collapse"
                                        data-target="#gq-faq-2">What can I do if I need to talk to you in an emergency
                                        ?</button></h5>
                            </div>
                            <div id="gq-faq-2" class="collapse" data-parent="#gq-faqs-1">
                                <div class="card-body">
                                    <p>If it is very urgent then you can call this number 16297. But calling this number may
                                        take some time. Because we are fulfilling the urgent need of other customers too.
                                        And if you call this number, you will be charged. Means no free number.</p>
                                </div>
                            </div>
                        </div>{{-- Card End --}}

                        {{-- Card Start --}}
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0"><button class="collapsed" data-toggle="collapse"
                                        data-target="#gq-faq-3">Well, I ordered it, but when will I receive the product
                                        ?</button></h5>
                            </div>
                            <div id="gq-faq-3" class="collapse" data-parent="#gq-faqs-1">
                                <div class="card-body">
                                    <p>Delivery is made within 3-5 working days within Dhaka and 5-7 working days outside
                                        Dhaka. But the time is more or less depending on the area.</p>
                                </div>
                            </div>
                        </div>{{-- Card End --}}

                        {{-- Card Start --}}
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0"><button class="collapsed" data-toggle="collapse"
                                        data-target="#gq-faq-4">How can I complain if I don't receive the product on time
                                        ?</button>
                                </h5>
                            </div>
                            <div id="gq-faq-4" class="collapse" data-parent="#gq-faqs-1">
                                <div class="card-body">
                                    <p>If you do not receive the delivery within the specified time, you can email
                                        delivery@botu.com as a delivery complaint. We will accept your complaint and
                                        take necessary steps for delivery.</p>
                                </div>
                            </div>
                        </div>{{-- Card End --}}

                    </div>{{-- FAQ (Accordion) End --}}
                </div>

                <div class="col-lg-6 col-12 accordion-2">
                    {{-- FAQ (Accordion) Start --}}
                    <div class="accordion" id="gq-faqs-2">

                        {{-- Card Start --}}
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0"><button class="collapsed" data-toggle="collapse"
                                        data-target="#gq-faq-5">Can I gift something to my loved ones through Botu
                                        ?</button>
                                </h5>
                            </div>
                            <div id="gq-faq-5" class="collapse" data-parent="#gq-faqs-2">
                                <div class="card-body">
                                    <p>Of course. You can order a gift by clicking on 'Order as a Gift' after 'Add to Cart'
                                        while placing the order on the site . After giving your name, mobile number and
                                        detailed address on the shipping page, you have to confirm the order with your loved
                                        one's name, mobile number and address at the receiver's house. But in this case you
                                        have to pay money in advance development or through card. If you want the gift
                                        parcel to be wrapped with gift wrapping paper, you have to select gift wrapping
                                        while ordering and you have to pay an additional 150 BDT .</p>
                                </div>
                            </div>
                        </div>{{-- Card End --}}

                        {{-- Card Start --}}
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0"><button class="collapsed" data-toggle="collapse"
                                        data-target="#gq-faq-6">Well, after receiving it, I found that the correct product
                                        did not arrive or for some reason I received a bad or a bad product. What to do then
                                        ?</button></h5>
                            </div>
                            <div id="gq-faq-6" class="collapse" data-parent="#gq-faqs-2">
                                <div class="card-body">
                                    <p>It is rare to be disappointed by purchasing a product from Rockmarie. But no one is
                                        above mistakes, we too can make mistakes while running such a huge operation. In
                                        case of defective products, Botu offers happy return facility. Report the product
                                        problem within 7 days and get fresh product or refund from Botu. Visit our
                                        return policy for details .</p>
                                </div>
                            </div>
                        </div>{{-- Card End --}}

                        {{-- Card Start --}}
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0"><button class="collapsed" data-toggle="collapse"
                                        data-target="#gq-faq-7">Well, while browsing the site, I saw that there is an option
                                        to give promocode while buying the product. What is this promocode ?</button></h5>
                            </div>
                            <div id="gq-faq-7" class="collapse" data-parent="#gq-faqs-2">
                                <div class="card-body">
                                    <p>Promocode is a secret number. By using the secret number you can get extra
                                        commission. Promocodes are offered from time to time for promotions. Keep an eye on
                                        Rockmarie's Facebook page to get various promocodes .</p>
                                </div>
                            </div>
                        </div>{{-- Card End --}}

                        {{-- Card Start --}}
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0"><button class="collapsed" data-toggle="collapse"
                                        data-target="#gq-faq-8">What is 'Wish List' ?</button>
                                </h5>
                            </div>
                            <div id="gq-faq-8" class="collapse" data-parent="#gq-faqs-2">
                                <div class="card-body">
                                    <p>Customer satisfaction is our primary goal. So if a customer likes a book/product but
                                        is unable to buy it at that particular moment, he can easily add that product to his
                                        wish list. So that in future he can check his wish list and buy it. The list of
                                        favorites in Rockmarly is called Wish List .</p>
                                </div>
                            </div>
                        </div>{{-- Card End --}}

                    </div>{{-- FAQ (Accordion) End --}}
                </div>

            </div>
        </div>
    </div>
    {{-- faq Page End --}}
@endsection
