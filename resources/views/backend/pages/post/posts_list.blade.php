@extends('backend.admin')
@section('content')
    <div class="mt-3" style="width: 35%; padding-left: 10px;">
        <h3 class="alert alert-success">Admin > List of Posts</h3>
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
                    <th scope="col" style="color: red;">User ID</th>
                    <th scope="col" style="color: red;">Category ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Tags</th>
                    <th scope="col">status</th>
                    <th scope="col">posted at</th>
                    <th scope="col" style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($posts->count() > 0)
                    @foreach ($posts as $key => $post)
                        <tr>
                            <td>{{ $key + $posts->firstItem() }}</td>
                            <td>{{ $post->user?->id }}</td>
                            <td>{{ $post->category?->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>
                                @foreach ($post->tags as $tag)
                                    <span class="badge bg-secondary">{{ $tag->name }}</span>
                                @endforeach
                            </td>
                            <td>{{ $post->status }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td style="text-align: center;">
                                <a href="{{ route('admin.post.show', $post->id) }}" class="btn btn-info">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.post.edit', $post->id) }}" class="btn btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{ route('admin.post.destroy', $post->id) }}" class="btn btn-danger"
                                    onclick="return confirm('Are you sure?')">
                                    <i class="fa-solid fa-trash-can text-dark"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8">
                            <h5 class="text-center">No posts Found</h5>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    {{ $posts->links() }}
@endsection
