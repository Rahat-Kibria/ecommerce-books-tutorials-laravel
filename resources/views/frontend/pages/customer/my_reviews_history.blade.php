@extends('frontend.pages.customer.customer_account')
@section('content_customer')
    <div class="col-lg-9 col-12 mt--30 mt-lg--0">
        <div class="tab-content" id="myaccountContent">
            {{-- Single Tab Content Start --}}
            <div id="reviewsratings">
                <div class="myaccount-content">
                    <h3>My Reviews History</h3>
                    @forelse ($products as $product)
                        @php
                            $order_details = App\Models\OrderDetails::where('product_id', $product->id)->first();
                            if (!empty($order_details->order_id)) {
                                $order = App\Models\Order::where('id', $order_details->order_id)
                                    ->where('user_id', auth()->user()->id)
                                    ->first();
                            } else {
                                $order = [];
                            }
                            $image = json_decode($product->image);
                            $product_review = App\Models\ProductReview::where('product_id', $product->id)
                                ->where('user_id', auth()->user()->id)
                                ->first();
                        @endphp
                        <div style="background-color: #eee; padding: 0 0 20px 10px; margin-bottom: 10px;">
                            <p>Purchased on @if (!empty($order))
                                    {{ $order->created_at->format('d M Y') }}
                                @endif
                            </p>
                            <div class="row" style="padding: 10px 50px 0 0; position: relative;">
                                <div class="col-lg-2">
                                    @if (!empty($image[0]))
                                        <img src="{{ url('/uploads/product_images/' . $image[0]) }}" height="70"
                                            width="60" alt="Product Image">
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
                                <div class="col-lg-2"
                                    style="border-left: 1px solid #000; bottom: 50%; height: 52px; position: absolute; margin: 0; top: 50%; left: 75%; -ms-transform: translateY(-50%); transform: translateY(-50%)">
                                    <a href="{{ route('botu.account.my_review.edit', $product->id) }}"
                                        class="btn btn-warning">Edit Review</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-7">
                                    <div class="rating-row pt-2">
                                        <div class="rating-block">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span
                                                    class="fas fa-star {{ $i <= $product_review->rating ? 'star_on' : '' }}"></span>
                                            @endfor
                                        </div>
                                        <div style="border: 1px solid #000; background-color: #fff; padding: 5px;">
                                            {{-- <textarea cols="10" rows="4" class="form-control" disabled>{{ $product_review->message }}</textarea> --}}
                                            <div>{{ $product_review->message }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3"></div>
                            </div>
                        </div>
                    @empty
                        <div class="row">
                            <div class="col-lg-4 col-sm-6">
                            </div>
                            <div class="col-lg-4 col-sm-6 d-flex justify-content-center">
                                <p class="alert alert-danger">Sorry, No Product(s) Found</p>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
            {{-- Single Tab Content End --}}
        </div>
    </div>
@endsection
