@extends('frontend.pages.customer.customer_account')
@section('content_customer')
    <div class="col-lg-9 col-12 mt--30 mt-lg--0">
        <div class="tab-content" id="myaccountContent">
            {{-- Single Tab Content Start --}}
            <div id="reviewsratings">
                <div class="myaccount-content">
                    <h3>To Be Reviewed</h3>
                    @forelse ($products as $product)
                        @php
                            $order_details = App\Models\OrderDetails::where('product_id', $product->id)->first();
                            $order = App\Models\Order::where('id', $order_details->order_id)
                                ->where('user_id', auth()->user()->id)
                                ->first();
                            $image = json_decode($product->image);
                        @endphp
                        <div style="background-color: #eee; padding: 0 0 20px 10px; margin-bottom: 10px;">
                            <p>Purchased on {{ $order?->created_at->format('d M Y') }}</p>
                            <div class="row" style="padding: 10px 50px 10px 0px; position: relative;">
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
                                    <a href="{{ route('botu.account.my_review.create', $product->id) }}"
                                        class="btn btn-warning">Review</a>
                                </div>
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
