<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\EditPostRequest;
use App\Jobs\PruneOldPostsJob;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Schedule;
// Schedule::job( new PruneOldPostsJob)->everyFiveMinutes();


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

    public function store(StorePostRequest $request){        
        $title = request()->title;
        $description = request()->description;
        $postCreatorr = request()->postCreator;
        // $image = request()->file('file');
        // dd($image);
        $post=Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreatorr
        ]);
        if (request()->hasFile('file')) {
            // $path = request()->file('file')->store('public/images');
            $path = request()->file('file')->store('images','public');
            
            // extract the file name from the stored path (to store only the file name in the DB)
            $pathArray = explode('/', $path);
            $imgPath = $pathArray[1]; // Image file name
            // dd($pathArray);
            // Save the image path in the post
            $post->image_path = $imgPath;
            $post->save();
        }

        // getting the posts that were created <= 2 years ago AND deleting them
        $oldPosts = Post::where('created_at', '<=', Carbon::now()->subYears(2))->get();
    
        // loop over ALL these posts and dispatch the job to delete them one by one
        foreach ($oldPosts as $oldPost) {
            PruneOldPostsJob::dispatch($oldPost);
        }
        // Post::create($validated);
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
        if(Storage::disk('public')->exists('images/'.$editPostById->image_path)) {
            Storage::disk('public')->delete('images/'.$editPostById->image_path); //delete from storage
        }
        // for the user to be a dropdown list of usernames in User DB
        $user=User::all();
    
        // when the user enters an id in the route that's NOT there
        return view('posts.edit', ['post' => $editPostById, 'users' => $user]);
    }
    
    public function update(EditPostRequest $request, $id)
    {
        $validated=$request->validated();
        $editPostById=Post::find($id);
        $editPostById->title = $validated['title'];
        $editPostById->description = $validated['description'];
        // dd(request()->all());
        if (request()->hasFile('file')) {
            // $path = request()->file('file')->store('public/images');
            $path = request()->file('file')->store('images','public');
            
            // extract the file name from the stored path (to store only the file name in the DB)
            $pathArray = explode('/', $path);
            $imgPath = $pathArray[1]; // image file name
            $editPostById->image_path = $imgPath;
            // $editPostById->save();
        }
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
    if(Storage::disk('public')->exists('images/'.$delPostById->image_path)) {
        Storage::disk('public')->delete('images/'.$delPostById->image_path); //delete from storage
    }
    $delPostById->delete();
    
    // delete the image from public/images
    
    // Redirect back to the posts index page
    return to_route('posts');
}
public function restore(){
    Post::onlyTrashed()->restore();
    return to_route('posts');
}

// public function upload(Request $request, $postId)
// {
//     // Validate the file
//     $validated=$request->validated();
//     $post = Post::findOrFail($postId);
//     $post->image_path = $validated['file'];
//     $path = $request->file('file')->store('public/images');
//     $pathArray = explode('/', $path);
//     $imgPath = $pathArray[1];

//     $post->image_path = $imgPath;
//     $post->save();

//     return redirect()->route('posts', $postId); // Or redirect to wherever you need
// }

}
