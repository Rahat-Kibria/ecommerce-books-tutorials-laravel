@extends('backend.admin')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="product p-4" style="height: 100%; background-color: #eee; text-align:center">
                        <div>
                            <a href="{{ route('admin.ebooks.list') }}" class="btn btn-info"> <i
                                    class="fa fa-long-arrow-left"></i> <span class="ms-1">Back</span> </a>
                        </div>
                        <div class="sizes mt-2">
                            <h6 class="text-uppercase d-inline">Product Name:</h6>
                            <span class="text-uppercase">{{ $ebook->product->name }}</span>
                        </div>
                        @php
                            $path = public_path() . $ebook->ebook_path;
                            $filesize = filesize($path);
                            function countPages($path)
                            {
                                $pdftext = file_get_contents($path);
                                $num = preg_match_all('/\/Page\W/', $pdftext, $dummy);
                                return $num;
                            }
                            $totoalPages = countPages($path);
                        @endphp
                        <div class="sizes mt-2">
                            <h6 class="text-uppercase d-inline">File Size:</h6>
                            <span class="text-uppercase">{{ floor($filesize / 1000) }} KB</span>
                        </div>
                        <div class="sizes mt-2">
                            <h6 class="text-uppercase d-inline">Total Pages:</h6>
                            <span class="text-uppercase">{{ $totoalPages }}</span>
                        </div>
                        <div class="sizes mt-3">
                            <h6 class="text-uppercase d-inline">File:</h6>
                            <object data="{{ asset($ebook->ebook_path) }}" type="application/pdf" width="50%"
                                height="400px">
                                <p>Unable to display PDF file. <a href="{{ asset($ebook->ebook_path) }}">Download</a>
                                    instead.</p>
                            </object>
                        </div>
                        <div class="cart mt-4 align-items-center">
                            <a type="button" href="{{ route('admin.ebook.edit', $ebook->id) }}"
                                class="btn btn-warning text-uppercase me-2 px-4"><i class="fa-solid fa-pen-to-square"></i>
                                Edit</a>
                            <form action="{{ route('admin.ebook.delete', $ebook->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger text-uppercase me-2 px-4"
                                    onclick="return confirm('Are you sure?')">
                                    <i class="fa-solid fa-trash-can text-dark"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
