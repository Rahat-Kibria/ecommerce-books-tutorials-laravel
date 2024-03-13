@extends('backend.admin')
@section('content')
    <div class="mt-3" style="width: 35%; padding-left: 10px;">
        <h3 class="alert alert-success">Admin > List of Ebooks</h3>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" style="margin: 10px;" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div style="padding: 10px;">
        <table class="table table-hover table-bordered table-success">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" style="color: red;">Product Name</th>
                    <th scope="col">File Size</th>
                    <th scope="col">Total Pages</th>
                    <th scope="col" style="text-align: center;">Action</th>
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
                        <td>{{ $key + $ebooks->firstItem() }}</td>
                        <td>{{ $ebook->product->name }}</td>
                        @php
                            $path = public_path() . $ebook->ebook_path;
                            $filesize = filesize($path);
                            $totoalPages = countPages($path);
                        @endphp
                        <td>{{ floor($filesize / 1000) }} KB</td>
                        <td>{{ $totoalPages }}</td>
                        <td style="text-align: center;">
                            <a href="{{ route('admin.ebook.view', $ebook->id) }}" class="btn btn-info">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.ebook.edit', $ebook->id) }}" class="btn btn-warning">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.ebook.delete', $ebook->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="fa-solid fa-trash-can text-dark"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $ebooks->links() }}
@endsection
