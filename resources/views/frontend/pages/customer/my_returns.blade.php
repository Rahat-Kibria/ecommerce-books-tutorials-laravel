@extends('frontend.pages.customer.customer_account')
@section('content_customer')
    <div class="col-lg-9 col-12 mt--30 mt-lg--0">
        <div class="tab-content" id="myaccountContent">
            {{-- Single Tab Content Start --}}
            <div id="returns">
                <div class="myaccount-content">
                    <h3>My Returns</h3>
                    <div class="myaccount-table table-responsive text-center">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Mostarizing Oil</td>
                                    <td>Aug 22, 2018</td>
                                    <td>Pending</td>
                                    <td>$45</td>
                                    <td><a href="cart.html" class="btn">View</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- Single Tab Content End --}}
        </div>
    </div>
@endsection
