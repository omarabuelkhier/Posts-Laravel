@extends('../layouts.app')
@section('title')
All Posts
@endsection

@section('content')

<div class="container mt-5">
    <h1 class="mb-5 mt-5 text-center fw-bolder" >All Posts</h1>
@if(session('destroyError'))
        <div class="alert alert-danger">
         {{session('destroyError')}}
    </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    @if(session('postRestored'))
        <div class="alert alert-success">
            {{session('postRestored')}}
        </div>
    @endif
    <table class="table table-striped table-bordered">
        <tr>
            <th>Post ID</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Creator Name</th>
             <th>Image</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        @foreach($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{ $post->slug }}</td>



                <td>
                    {{$post->creator->name? $post->creator->name:'none'}}
                </td>
                 <td><img  src="{{asset('images/posts/'.$post->image)}}" width="150" height="150" /></td>

                <td>{{$post->HumanReadableCreatedAt()}}</td>
{{--                <td>{{$post->created_at->format('dS M Y H:i:s A')}}</td>--}}

                <td>
                    | <x-button route="{{route('posts.show', $post)}}" color="primary" message="Show" />
                    @can('update-post', $post)
                        <!-- The current user can update the post... -->
                        |  <x-button route="{{route('posts.edit', $post)}}" color="secondary" message="Edit" />
                    @endcan
                     |
                    <form action="{{route('posts.destroy', $post)}}" method="post">
                        @csrf
                        @method('delete')
                        | <button type="submit" class="btn btn-danger mt-2"
                            onclick="return confirm('Are You Sure Want To Delete This Post?')">Archive</button> |
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="container-fluid text-center"> {{$posts->links()}} </div>

</div>
<a href="{{route('posts.create')}}" class="btn btn-success w-25 fw-bolder fs-5 mt-5 mb-5" style="height: 2.5em;">
    Create Post</a>

<form action="{{route('posts.archive', $post)}}" method="post">
    @csrf
    <button class="btn btn-danger w-25 fw-bolder fs-5 mt-5 mb-5" type="submit" style="height: 2.5em;"> Archived Posts
    </button>

</form>


@endsection
