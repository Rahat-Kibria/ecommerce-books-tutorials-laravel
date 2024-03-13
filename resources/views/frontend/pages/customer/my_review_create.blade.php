@extends('frontend.pages.customer.customer_account')
@section('content_customer')
    <div class="col-lg-9 col-12 mt--30 mt-lg--0">
        <div class="tab-content" id="myaccountContent">
            {{-- Single Tab Content Start --}}
            <div id="reviewsratings">
                <div class="myaccount-content">
                    <h2 class="title-lg mb--20 pt--15">ADD A REVIEW</h2>
                    @php
                        $order_details = App\Models\OrderDetails::where('product_id', $product->id)->first();
                        $order = App\Models\Order::where('id', $order_details->order_id)
                            ->where('user_id', auth()->user()->id)
                            ->first();
                        $image = json_decode($product->image);
                    @endphp
                    <p>Purchased on {{ $order?->created_at->format('d M Y') }}</p>
                    <div class="row"
                        style="padding: 10px 50px 10px 0px; margin-bottom: 10px; background-color: #eee; position: relative;">
                        <div class="col-lg-2">
                            @if (!empty($image[0]))
                                <img src="{{ url('/uploads/product_images/' . $image[0]) }}" height="70" width="60"
                                    alt="Product Image">
                            @else
                                <img src="{{ url('/uploads/default/no_image.jpg') }}" height="70" width="60"
                                    alt="No Image">
                            @endif
                        </div>
                        <div class="col-lg-8"
                            style="font-size: 1.5rem; border-left: 1px solid #000; position: absolute; margin: 0; top: 50%; left: 15%; -ms-transform: translateY(-50%); transform: translateY(-50%)">
                            @if ($product->type == 'Book')
                                <a
                                    href="{{ route('botu.product.details', [$product->id, $product->slug]) }}">{{ $product->name }}</a>
                            @else
                                <a
                                    href="{{ route('botu.tutorial.details', [$product->id, $product->slug]) }}">{{ $product->name }}</a>
                            @endif
                        </div>
                        <div class="col-lg-2">
                        </div>
                    </div>
                    <div class="rating-row pt-2">
                        <p class="d-block">Your Rating *</p>
                        <span class="rating-widget-block">
                            <input type="radio" name="rating" id="star1" value="5" form="review_rating_form"
                                required>
                            <label for="star1"></label>
                            <input type="radio" name="rating" id="star2" value="4" form="review_rating_form"
                                required>
                            <label for="star2"></label>
                            <input type="radio" name="rating" id="star3" value="3" form="review_rating_form"
                                required>
                            <label for="star3"></label>
                            <input type="radio" name="rating" id="star4" value="2" form="review_rating_form"
                                required>
                            <label for="star4"></label>
                            <input type="radio" name="rating" id="star5" value="1" form="review_rating_form"
                                required>
                            <label for="star5"></label>
                        </span>
                        @if ($errors->has('rating'))
                            @foreach ($errors->get('rating') as $error)
                                <small class="text-danger">{{ $error }}</small>
                            @endforeach
                        @endif
                        <form action="{{ route('botu.account.my_review.submit') }}" class="mt--15 site-form "
                            id="review_rating_form" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-7">
                                    <div class="form-group">
                                        <label for="message">Comment *</label>
                                        <textarea name="message" id="message" cols="30" rows="10" class="form-control" required></textarea>
                                    </div>
                                    @if ($errors->has('message'))
                                        @foreach ($errors->get('message') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-lg-5">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}" required>
                                    @if ($errors->has('product_id'))
                                        @foreach ($errors->get('product_id') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <div class="submit-btn">
                                        <button type="submit" class="btn btn-black">Post Comment</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Single Tab Content End --}}
        </div>
    </div>
@endsection
