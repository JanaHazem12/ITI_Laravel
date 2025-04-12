<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index(){
        $posts = Post::with('user')->paginate(10);
        // return $post;
        return PostResource::collection($posts);
    }
    public function show($id){
        $post = Post::find($id);
        // return $post;
        // return [
        //     'id' => $post->id,
        //     'title' => $post->title,
        //     'desciption' =>  $post->description
        // ];
        // resources are made in order to display specific cols. coming from the db
        return new PostResource($post);

    }
    public function store(StorePostRequest $request){
        $title = request()->title;
        $description = request()->description;
        $postCreatorr = request()->postCreator;

        $post=Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreatorr
        ]);
        // return $post;
        return new PostResource($post);
    }
}
