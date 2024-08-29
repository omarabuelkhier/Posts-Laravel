<?php

namespace App\Http\Controllers\Api\Api;

use App\Http\Controllers\Controller;
use App\Models\post;
use App\Rules\preventPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PostResource;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post= post::all();
        return PostResource::collection($post);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $postValidator = Validator::make($request->all(),[
            'title' => ['required', 'min:3',new preventPost(),'unique:App\Models\post'],
            'description' => ['required', 'string', 'min:3', 'max:255'],
            'image' => 'mimes:jpeg,png,jpg,gif',
            'creator_id' => ['required', 'exists:App\Models\User,id'],
        ]);
         if($postValidator->fails()){
//             return response(['errors'=>$postValidator->errors()->all()],422);
             return response()->json([
                 'validation_errors' => $postValidator->errors(),
                 'message' => 'Please check your inputs',
                 'typealert'=>'danger',
                 'status'=>422
             ],422);

         }
        $image_path=null;
        if($request->hasFile('image')){
            $image=$request->file('image');
            $image_path=$image->store('images','posts_upload');
        }
        $request_data=$request->all();
        $request_data['image']=$image_path;
        $post=post::create($request_data);
        return new PostResource($post);
      }

    /**
     * Display the specified resource.
     */
    public function show(post $post)
    {
        return new postResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, post $post)
    {
        $request->all();
        $postValidator = Validator::make($request->all(), [
            'title' => ['required', 'min:3', new preventPost(), Rule::unique('posts')->ignore($post)],
            'description' => ['required', 'string', 'min:3', 'max:255'],
            'image' => 'mimes:jpeg,png,jpg,gif',
            'creator_id' => ['required', 'exists:App\Models\User,id'],
        ]);
        if ($postValidator->fails()) {
//             return response(['errors'=>$postValidator->errors()->all()],422);
            return response()->json([
                'validation_errors' => $postValidator->errors(),
                'message' => 'Please check your inputs',
                'typealert' => 'danger',
                'status' => 422
            ], 422);
        }
        $image_path=$post->image;
        if($request->hasFile('image')){
            $image=$request->file('image');
            $image_path=$image->store('images','posts_upload');

        }
        $request_data=$request->all();
        $request_data['image']=$image_path;
        $post->update($request_data);
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(post $post)
    {
        $post->delete();
        return 'deleted';
    }
}
