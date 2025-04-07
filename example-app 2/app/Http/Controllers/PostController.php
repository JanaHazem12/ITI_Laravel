<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public $posts;

    public function index(){
        // $this->posts = [
        //     ['id' => 1, 'title' => 'Learn PHP', 'Posted By' => 'Ahmed', 'Created At' => '2018-04-10'],
        //     ['id' => 2, 'title' => 'Master Laravel', 'Posted By' => 'Sara', 'Created At' => '2020-07-22'],
        //     ['id' => 3, 'title' => 'JavaScript Basics', 'Posted By' => 'Omar', 'Created At' => '2019-11-15'],
        //     ['id' => 4, 'title' => 'Tailwind CSS Guide', 'Posted By' => 'Laila', 'Created At' => '2021-01-05'],
        // ];

        // select * from iti-posts
        // $getPosts = Post::all();

        $getPosts = Post::paginate(10);
        // retrieve a limited set of records based on the current page
        // automatically handles the logic for determining which records to fetch

        // dd($getPosts); // returns an object of type collection

        // if (!session()->has('posts')) {
        //     session(['posts' => $this->posts]);
        // }

        return view('posts.index', ['posts'=>$getPosts]);
        // instead of writing key value in the 2nd param, search about COMPACT ^^
        // we give it a key and it matches the value instantly
    }

    public function create(Request $request){
        // add the newly created post in the table
        // insert into iti-posts values(value from inputs)
        // create a new table for users
        // select * users from Users (to use in the dd list)
        $getUsers = User::all();
        return view('posts.create',['users'=>$getUsers]);
    }
    public function show($id){
        // must pass $id to this function
        // $post = [
        //     [
        //         'title' => 'Learn PHP',
        //         'description' => 'Intro to PHP fundamentals',
        //         'user' => [
        //             'name' => 'Ahmed',
        //             'email' => 'ahmed@example.com',
        //             'created_at' => '2018-04-10'
        //         ]
        //     ]
        // ];  
        // select * from iti-posts
        // where id = $id 
        $getPostById = Post::find($id);
    // $getPostById = Post::where('id',$id->first()); ANOTHER SYNTAX --> returns 1 eloquent object
    // without -> first it returns an eloquent builer, it acts like a terminator of the query
        return view('posts.show',['post'=>$getPostById]);
    }

    public function store(Request $request){
        // dd($request->all());        
        // WE CAN VALIDATE THE DATA COMING FROM THE INPUTS SUBMITTED BY THE USER **
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string'
        ]);
        // form request (validation in another file) - for cleaner code and error messages
        // to store the submitted data in the DB:
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        // dd($request->all());
        $post->save(); 
        // use $post->create() instead of save
        return to_route('posts');
        // another better approach --> $validatedData = $request->validated(); (create the record in one step)
    }
    
    public function edit($id)
    {
        // $post = session(key: 'posts',$this->posts);
        // $findPost = null;
        // for($i=0; $i<count($post);$i++){
        //     if($post[$i]['id']==$id){
        //         $findPost=$post[$i];
        //         break;
        //     }
        // }

        // if (!$findPost) {
        //     abort(404);
        // }

        $editPostById=Post::find($id);
        // for the user to be a dropdown list of usernames in User DB
        $user=User::all();
    
        // when the user enters an id in the route that's NOT there
        return view('posts.edit', ['post' => $editPostById, 'users' => $user]);
    }
    
    public function update(Request $request, $id)
    {
        // $post = session('posts',$this->posts);
        // $findPost = null;
        // $postIndex=0;
        // // array filter by id and update this $post instead of the loop
        // for($i=0; $i<count($post);$i++){
        //     if($post[$i]['id']==$id){
        //         $findPost=$post[$i];
        //         $postIndex=$i;
        //         break;
        //     }
        // }

        // if (!$findPost) {
        //     abort(404);
        // }
        
        // update the post's title, Posted By, Created At
        // $findPost['title'] = request('title');
        // $findPost['Posted By'] = request('Posted By');
        // $findPost['Created At'] = request('Created At');
        // $post[$postIndex]=$findPost;
        // session(['posts'=>$post]);
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);
        $editPostById=Post::find($id);
        $editPostById->title = $request->title;
        $editPostById->description = $request->description;
        // dd($request->all());
        $editPostById->save();
        return to_route('posts');
    }

    public function confirmDelete($id){
        $delPostById = Post::findOrFail($id);
        return view('posts.delete', ['post' => $delPostById]);
    }
    // BONUS: SOFT DELETE - DONE

   public function delete($id)
{
    // dd(request()->method()); // Check the method sent in the request
    // Find the post by ID and delete it
    $delPostById = Post::findOrFail($id);
    $delPostById->delete();
    
    // Redirect back to the posts index page
    return to_route('posts');
}
public function restore(){
    Post::onlyTrashed()->restore();
    return to_route('posts');
}

}
