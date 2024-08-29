@extends('../layouts.app')
@section('title')
Soft Deleted Posts
@endsection

@section('content')
<h1 class="text-center">Soft Deleted Posts</h1>
<div class="container mt-5">
    <table class="table table-striped table-bordered">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Posted By</th>
             <th>Image</th>
            <th>Created At</th>
            <th>Deleted At</th>
            <th>Actions</th>
        </tr>
        @foreach($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->creator->name}}</td>
                <td><img  src="{{asset('images/posts/'.$post->image)}}" width="150" height="150" /></td>
                <td>{{$post->created_at->format('dS M Y H:i:s A')}}</td>
                <td>{{$post->deleted_at->format('dS M Y H:i:s A')}}</td>
                <td>
                    <form action="{{route('posts.hardDelete', $post)}}" method="post">
                        @csrf
                        @method('delete')
                        | <button type="submit" class="btn btn-danger mt-2"
                            onclick="return confirm('Are You Sure Want To Delete This Post Permanentley?')">Delete</button>
                        |
                    </form>
                    <form action="{{route('posts.restore', $post)}}" method="post">
                        @csrf
                        | <button type="submit" class="btn btn-success mt-2"
                            onclick="return confirm('Are You Sure Want To Restore This Post?')">Restore</button>
                        |
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

</div>
<a href="{{route('posts.index')}}" class="btn btn-success w-25 fw-bolder fs-5 mt-5 mb-5" style="height: 2.5em;">
    All Posts</a>


@endsection
