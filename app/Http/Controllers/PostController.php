<?php

namespace App\Http\Controllers;

use AllowDynamicProperties;
use App\Models\Creator;
use Illuminate\Contracts\View\Factory;
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
        $creators = Creator::paginate(3);

        return view('postsTask.index', compact('posts','creators'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $creators = Creator::all();
        $post = post::all();

        return view('postsTask.create', compact('creators','post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepostRequest $request)
    {
//        request()->validate([
//            'title' => 'required|min:3|unique:App\Models\post',
//            'description' => ['required', 'string', 'min:3', 'max:255'],
////            'creator' => ['required', 'string', 'min:3', 'max:255'],
//             'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
//
//        ]);
//        $data = request()->all();
//        $title = $data['title'];
//        $description = $data['description'];
        // $creator = $data['creator'];
        // $creator = $data['image'];
        // $created_at = $data['created_at'];// $date = Carbon::now();
//        $postCreate = new post();
//        $postCreate->title = $title;
//        $postCreate->description = $description;
        // $postCreate->creator = $creator;
        // $postCreate->created_at = $created_at->format('l dS F o H:i:s A ');
        // $postCreate->image = $request->file('image')->store('images/posts');
//        $postCreate->save();
     $image_path=null;
     if($request->hasFile('image')){
         $image=$request->file('image');
         $image_path=$image->store('images','posts_upload');

     }
//        $request_data=$request->only(['title', 'description', 'image']);

        $request_data=$request->all();
        $request_data['image']=$image_path;

        $creators = Creator::all();

       $post =post::create($request_data);
        return to_route('postsTask.index', compact('post','creators'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = post::findOrFail($id);
        return view('postsTask.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,string $id ,post $post)
    {
        $creators = Creator::all();

        $post = post::findOrFail($id);
        return view('postsTask.update',compact('post','creators'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,UpdatepostRequest $request, post $posts)
    {
        request()->validate([
            'title' => 'required|min:3',
            'description' => 'required|string|min:3|max:255',
//            'creator' => ['required', 'string', 'min:3', 'max:255'],
            'image' => 'required|mimes:jpeg,png,jpg,gif',

        ]);
//        $image_path=$post->image;
//        if($request->hasFile('image')){
//            $image=$request->file('image');
//            $image_path=$image->store('images','posts_upload');
//
//        }
//        $request_data=$request->all();
//        $request_data['image']=$image_path;
//        // $date = Carbon::now();
//        $post->update($request_data);

        $image_path = $posts->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_path = $image->store('images', 'posts_upload');
        }

        $title = $request['title'];
        $description = $request['description'];

        $posts = post::findOrFail($id);
        $creator = $posts->creator->creator;

        $posts->title = $title;
        $posts->description = $description;
        $posts->creator->creator = $creator;
        $posts->image = $image_path;

        $posts->save();

        return to_route('postsTask.index',['post' => $posts]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = post::find($id);
        $post->delete();
        return to_route('postsTask.index');
    }
    public function hardDelete($id)
    {
        $post = post::withTrashed()->where('id', $id);

        if (!($post == null)) {

            $post->forceDelete();
            return to_route('postsTask.index');
        }

        return to_route('postsTask.index');
    }
    public function archive()
    {
        $posts = post::onlyTrashed()->orderBy('created_at', 'desc')->get();
        // $post->delete();
        return view('postsTask.archive', ['posts' => $posts]);
    }

    public function restore($id)
    {
        $post = post::withTrashed()->findOrFail($id);
        $post->restore();
        return to_route('postsTask.index');
    }




}
