@extends('../layouts.app')



@section('content')
<form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="container mt-5">
        <div class="mb-3 text-start">
            <label for="exampleFormControlInput1" class="form-label fw-bolder">Title</label>
            <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Title Name"
                value="">
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3 text-start">
            <label for="exampleFormControlTextarea1" class="form-label fw-bolder">Description</label>
            <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                rows="3"></textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3 text-start">
            <label for="exampleFormControlInput1" class="form-label fw-bolder">Image</label>
            <input type="file" name="image" class="form-control"
                placeholder="Upload Your Image" id="imageCreate" >
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3 text-start">

                <label for="creator" class="form-label">Post Creator</label>
                <input type="text" value="{{ Auth::user()->name }}" class="form-control" id="Creator" disabled>

            @error('creator')
            <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>

        <div class="col-12 text-center mt-5">
            <button class="btn btn-success w-25" type="submit">Create</button>
        </div>
    </div>
</form>
@endsection
