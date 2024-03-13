@extends('backend.admin')
@section('content')
    <div class="mt-3" style="width: 35%; padding-left: 10px;">
        <h3 class="alert alert-success">Admin > List of Audios</h3>
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
                    <th scope="col">Duration</th>
                    <th scope="col" style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($audios as $key => $audio)
                    <tr>
                        <td>{{ $key + $audios->firstItem() }}</td>
                        <td>{{ $audio->product->name }}</td>
                        @php
                            $path = public_path() . $audio->audio;
                            $filesize = filesize($path);
                            $ratio = 6900; //128Kb
                            $duration = $filesize / $ratio;
                            $hours = 0;
                            $minutes = floor($duration / 60);
                            $seconds = floor($duration - $minutes * 60);
                        @endphp
                        <td>{{ floor($filesize / 1000) }} KB</td>
                        <td>{{ $hours }}:{{ $minutes }}:{{ $seconds }}</td>
                        <td style="text-align: center;">
                            <a href="{{ route('admin.audio.view', $audio->id) }}" class="btn btn-info">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.audio.edit', $audio->id) }}" class="btn btn-warning">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.audio.delete', $audio->id) }}" method="POST">
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
    {{ $audios->links() }}
@endsection
