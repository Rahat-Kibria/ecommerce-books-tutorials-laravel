@extends('frontend.pages.customer.customer_account')
@section('content_customer')
    <div class="col-lg-9 col-12 mt--30 mt-lg--0">
        <div class="tab-content" id="myaccountContent">
            {{-- Single Tab Content Start --}}
            <div id="downloads">
                <div class="myaccount-content">
                    <h3>My Purchased Courses</h3>
                    <div class="myaccount-table table-responsive text-center">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Thumbnail</th>
                                    <th>Course Name</th>
                                    <th>Purchase Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        @php
                                            $image = json_decode($product->image);
                                            $order_ids = \App\Models\OrderDetails::where('product_id', $product->id)
                                                ->pluck('order_id')
                                                ->all();
                                            $orders = \App\Models\Order::whereIn('id', $order_ids)->get();
                                            $order = $orders->where('user_id', auth()->user()->id)->first();
                                        @endphp
                                        <td>
                                            <img src="{{ url('/uploads/product_images/' . $image[0]) }}"
                                                style="height:60px; width:50px;" alt="Product Image">
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td><a href="{{ route('botu.tutorial.details', [$product->id, $product->slug]) }}"
                                                class="btn">VIEW</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- Single Tab Content End --}}
        </div>
    </div>
@endsection
