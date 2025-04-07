<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $id){
        $getPostId = Post::find($id);
        $comment = new Comment;
        $comment->post_id = $id;
        $comment->comment_body=$request->comment_body;
        $comment->save();
        return to_route('posts.show',['post'=>$getPostId]);
    }
    public function edit(Request $request, $id){
        // get the comment with this specific commentId
        $getCommId = Comment::find($id);
        $getCommId->comment_body=$request->edited_body;
        // $getPostId = Post::find($id);
        // $getCommId->post_id = $id;
        $getCommId->save();
        $getPostId = Post::find($getCommId->post_id);
        return to_route('posts.show',['post'=>$getPostId,'comment'=>$getCommId]);
    }
    public function delete($id){
        // delete the comment with this specific commentId
        $getCommId = Comment::find($id);
        $getCommId->delete();
        $getPostId = Post::find($getCommId->post_id);
        return to_route('posts.show',['post'=>$getPostId,'comment'=>$getCommId]);
    }
}
