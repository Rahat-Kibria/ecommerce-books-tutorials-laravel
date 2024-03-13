@extends('backend.admin')
@section('content')
    <div class="mt-3" style="width: 35%; padding-left: 10px;">
        <h3 class="alert alert-success">Admin > List of Tags</h3>
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
                    <th scope="col">Name</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Description</th>
                    <th scope="col" style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($tags->count() > 0)
                    @foreach ($tags as $key => $tag)
                        <tr>
                            <td>{{ $key + $tags->firstItem() }}</td>
                            <td>{{ $tag->name }}</td>
                            <td>{{ $tag->slug }}</td>
                            <td>
                                <p style="width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $tag->description }}
                                </p>
                            </td>
                            <td style="text-align: center;">
                                <a href="{{ route('tag.show', $tag->id) }}" class="btn btn-info">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('tag.edit', $tag->id) }}" class="btn btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{ route('tag.delete', $tag->id) }}" class="btn btn-danger"
                                    onclick="return confirm('Are you sure?')">
                                    <i class="fa-solid fa-trash-can text-dark"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">
                            <h5 class="text-center">No Tags Found</h5>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    {{ $tags->links() }}
@endsection
