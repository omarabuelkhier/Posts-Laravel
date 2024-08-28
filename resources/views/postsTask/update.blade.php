@extends('../layouts.app')
@section('title')
Post Creation
@endsection


@section('content')
<form action="{{route('postsTask.update', $post)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="container mt-5">
        <div class="text-start mb-3">
            <label for="exampleFormControlInput1" class="form-label  fw-bolder">Title</label>
            <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Title Name" value="{{$post->title}}">
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="text-start mb-3">
            <label for="exampleFormControlTextarea1" class="form-label fw-bolder">Description</label>
            <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                rows="3"> {{$post->description}} </textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3 text-start">
            <label for="exampleFormControlInput1" class="form-label fw-bolder">Image</label>
            <input type="file" name="image" class="form-control" placeholder="Upload Your Image" id="imageCreate" value="{{old($post->image)}}" src="{{asset('images/posts/'.$post->image)}}">
            <img src="{{asset('images/posts/'.$post->image)}}" width="100" height="100">
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="text-start mb-3">
            <label for="exampleFormControlInput1" class="form-label fw-bolder">Creator</label>


            <select class="form-select" name="creator_id">
                @foreach($creators as $creator)
                    @if($creator->id==$post->creator_id)
                        <option value="{{$creator->id}}" selected>{{$creator->creator}}</option>
                    @else
                        <option value="{{$creator->id}}">{{$creator->creator}}</option>
                    @endif
                @endforeach
            </select>
            @error('creator')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-12 text-center mt-5">
            <button class="btn btn-primary w-25" type="submit">Update</button>
        </div>
    </div>
</form>
@endsection
