<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $posts;

    public function index()
    {
        $this->posts = [
            ['id' => 1, 'title' => 'Learn PHP', 'Posted By' => 'Ahmed', 'Created At' => '2018-04-10'],
            ['id' => 2, 'title' => 'Master Laravel', 'Posted By' => 'Sara', 'Created At' => '2020-07-22'],
            ['id' => 3, 'title' => 'JavaScript Basics', 'Posted By' => 'Omar', 'Created At' => '2019-11-15'],
            ['id' => 4, 'title' => 'Tailwind CSS Guide', 'Posted By' => 'Laila', 'Created At' => '2021-01-05'],
        ];
        return view('posts.index', ['posts' => $this->posts]); 
    }
    public function create(){
        return view('posts.create'); 
    }
    public function show(){
        $post = [
            [
                'title' => 'Learn PHP',
                'description' => 'Intro to PHP fundamentals',
                'user' => [
                    'name' => 'Ahmed',
                    'email' => 'ahmed@example.com',
                    'created_at' => '2018-04-10'
                ]
            ]
        ];        
        return view('posts.show',['post'=>$post]);
    }

    public function store(Request $request){
        dd($request->all());
        return 'WE ARE HERE';
        // return to_route('posts');
    }
    
    public function edit($id)
    {
        // Find the post by ID
        $post = collect($this->posts)->firstWhere('id', $id);
    
        if (!$post) {
            // Post not found
            return redirect()->route('posts')->with('error', 'Post not found');
        }
    
        return view('posts.edit', ['post' => $post]);
    }
    
    public function update(Request $request, $id)
    {
        // Find the post by ID
        $postIndex = collect($this->posts)->search(fn($post) => $post['id'] == $id);
    
        if ($postIndex === false) {
            // Post not found
            return redirect()->route('posts')->with('error', 'Post not found');
        }
    
        // Update the post's title, Posted By, and Created At
        $this->posts[$postIndex]['title'] = $request->input('title');
        $this->posts[$postIndex]['Posted By'] = $request->input('Posted By');
        $this->posts[$postIndex]['Created At'] = $request->input('Created At');
    
        // Redirect to the posts index page
        return redirect()->route('posts')->with('success', 'Post updated successfully');
    }
}
