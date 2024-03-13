@extends('frontend.pages.customer.customer_account')
@section('content_customer')
    <div class="col-lg-9 col-12 mt--30 mt-lg--0">
        <div class="tab-content" id="myaccountContent">
            {{-- Single Tab Content Start --}}
            <div id="downloads">
                <div class="myaccount-content">
                    <h3>My Audio Books</h3>
                    <div class="myaccount-table table-responsive text-center">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Audio File</th>
                                    <th>File Size</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($audios as $key => $audio)
                                    <tr>
                                        @php
                                            $product = \App\Models\Product::where('id', $audio->product_id)->first();
                                            $path = public_path() . $audio->audio;
                                            $filesize = filesize($path);
                                            $ratio = 6900;
                                            $duration = $filesize / $ratio;
                                            $hours = 0;
                                            $minutes = floor($duration / 60);
                                            $seconds = floor($duration - $minutes * 60);
                                        @endphp
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>
                                            <a href="{{ asset($audio->audio) }}">DOWNLOAD</a>
                                        </td>
                                        <td>{{ floor($filesize / 1000) }} KB</td>
                                        <td>{{ $hours }}:{{ $minutes }}:{{ $seconds }}</td>
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
