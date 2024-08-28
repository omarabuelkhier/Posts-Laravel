@extends('../layouts.app')
@section('title')
Post Details
@endsection
@section('postCard')
<div class="card text-bg-secondary mb-3 w-50 text-center ms-5 h-75">
    <div class="card-header fw-bolder">Post Info</div>
    <div class="card-body">
        <h5 class="card-title fw-bold">Title:- <span>{{$post->title}}</span> </h5>
        <h5 class=" text-start card-title fw-bold">Description:- {{$post->description}} </h5>

    </div>
</div>
<div class="card text-bg-secondary mb-3 w-25  ms-5 h-75">
    <div class="card-header fw-bolder">Post Creator Info</div>
    <div class="card-body">
        <h5 class="text-start card-title fw-bold">Name:- <span> {{$post->creator->creator}}</span></h5>
        <h5 class="text-start card-title fw-bold">Email:- <span> {{str_replace(' ', '', (strtolower($post->creator->creator)))}}@gmail.com</span> </h5>
        <h5 class="text-start card-title fw-bold">Created at:- <span>
                {{$post->created_at->format('dS M Y H:i:s A')}}</span>
        </h5>
        <h5 class="text-start card-title fw-bold">Updated at:- <span>
                {{$post->updated_at->format('dS M Y H:i:s A')}}</span>
        </h5>
         <img src="{{asset('images/posts/' . $post->image)}}" width="150" height="150"></img>

    </div>

</div>
<div class="card text-bg-secondary mb-3 w-50  ms-5 h-75">

    <div class="mb-3 text-start">
        <label for="exampleFormControlTextarea1" class="form-label fw-bolder">comment:</label>
        <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>
        <div class="container text-center mt-2"></div>
        <a href="{{route('postsTask.index')}}" class="btn btn-success w-25 text-center">Submit</a>
    </div>
</div>
</div>
<div class="col-12 text-center mt-5">
    <a href="{{route('postsTask.index')}}" class="btn btn-success w-25">BACK TO ALL POSTS</a>
</div>
@endsection
