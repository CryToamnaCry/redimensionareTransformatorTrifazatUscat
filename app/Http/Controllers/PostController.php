<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
         //eagle loding -> with(['user','likes']) = to have not so many querries
        $posts= Post::latest()->with(['user','likes'])->paginate(15);

        return view('posts.index',[
            'posts'=> $posts
        ]);
    }

   
    public function store(Request $request){

        $this->validate($request,[
            'body'=>'required'
        ]);

        $request->user()->posts()->create($request->only('body'));

        return back();
      
    }

    public function show(Post $post)
    {
        return view('posts.show',[
            'post' => $post
        ]);
    }

    public function destroy(Post $post){
        //check if another user than the loggedin one tries to delete post
        $this->authorize('delete', $post); //trows an exception

        $post->delete();

        return back();
    }
}
