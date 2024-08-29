<?php

namespace App\Http\Controllers;

use AllowDynamicProperties;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\post;
use Illuminate\Http\Request;
use App\Http\Requests\StorepostRequest;
use App\Http\Requests\UpdatepostRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {

        $posts = post::paginate(3);
        return view('posts.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $post = post::all();

        return view('posts.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepostRequest $request)
    {
     $image_path=null;
     if($request->hasFile('image')){
         $image=$request->file('image');
         $image_path=$image->store('images','posts_upload');

     }
        $request_data=$request->all();
        $request_data['image']=$image_path;
        $request_data['creator_id']=Auth::id();
        $post =post::create($request_data);
        return to_route('posts.index', compact('post'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = post::findOrFail($id);

        if (Auth::user()) {
            return view('posts.show', ['post' => $post]);
        }
        return to_route('posts.index',compact('post'))->with('Error', 'Unauthorized, You Have to Login First');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(post $post): \Illuminate\Foundation\Application|Factory|\Illuminate\Contracts\View\View
    {

//        $post = post::findOrFail($id);
        return view('posts.update',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepostRequest $request, post $post)
    {
        $image_path=$post->image;
        if($request->hasFile('image'))
        {
            $image=$request->file('image');
            $image_path=$image->store('images','posts_upload');
        }
        $request_data=$request->all();
        $request_data['image']=$image_path;
        $request_data['creator_id']=Auth::id();
        $post->update($request_data);

        return to_route('posts.index');
    }
    public function destroy($id,)
    {
        $post = post::find($id);

        if (Auth::id()==$post->creator_id) {
//            if ($post->creator_id == Auth::id()) {
                $post->delete();
                return to_route('posts.index', compact('post'))->with('success', 'Post Archived Successfully');;
//            }
        }
        return to_route('posts.index',compact('post'))->with('Error', 'Unauthorized, You cannot delete this post');

    }
    public function hardDelete($id)
    {
        $post = post::withTrashed()->where('id', $id);

        if (!($post == null)) {

            $post->forceDelete();
            return to_route('posts.index');
        }

        return to_route('posts.index');
    }
    public function archive()
    {
        $posts = post::onlyTrashed()->orderBy('created_at', 'desc')->get();
        // $post->delete();
        return view('posts.archive', ['posts' => $posts]);
    }

    public function restore($id)
    {
        $post = post::withTrashed()->findOrFail($id);
        $post->restore();
        return to_route('posts.index')->with('postRestored', 'Post Restored Successfully');
    }




}
