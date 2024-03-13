@extends('frontend.pages.customer.customer_account')
@section('content_customer')
    <div class="col-lg-9 col-12 mt--30 mt-lg--0">
        <div class="tab-content" id="myaccountContent">
            {{-- Single Tab Content Start --}}
            <div id="payment">
                <div class="myaccount-content">
                    <h3>Payment Method</h3>
                    <p class="saved-message">You Haven't Saved Your Payment Method yet.</p>
                </div>
            </div>
            {{-- Single Tab Content End --}}
        </div>
    </div>
@endsection
