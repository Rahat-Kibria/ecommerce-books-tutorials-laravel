@extends('frontend.pages.customer.customer_account')
@section('content_customer')
    <div class="col-lg-9 col-12 mt--30 mt-lg--0">
        <div class="tab-content" id="myaccountContent">
            {{-- Single Tab Content Start --}}
            <div id="downloads">
                <div class="myaccount-content">
                    <h3>My Ebooks</h3>
                    <div class="myaccount-table table-responsive text-center">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Ebook File</th>
                                    <th>File Size</th>
                                    <th>Pages</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    function countPages($path)
                                    {
                                        $pdftext = file_get_contents($path);
                                        $num = preg_match_all('/\/Page\W/', $pdftext, $dummy);
                                        return $num;
                                    }
                                @endphp
                                @foreach ($ebooks as $key => $ebook)
                                    <tr>
                                        @php
                                            $product = \App\Models\Product::where('id', $ebook->product_id)->first();
                                            $path = public_path() . $ebook->ebook_path;
                                            $filesize = filesize($path);
                                            $totoalPages = countPages($path);
                                        @endphp
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>
                                            <a href="{{ asset($ebook->ebook_path) }}">DOWNLOAD</a>
                                        </td>
                                        <td>{{ floor($filesize / 1000) }} KB</td>
                                        <td>{{ $totoalPages }}</td>
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
