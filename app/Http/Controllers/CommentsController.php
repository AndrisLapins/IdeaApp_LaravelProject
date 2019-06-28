<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;

class CommentsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'about']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Comment::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($post_id)
    {
        return view('comments.create')->with('post_id',$post_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Create Post
        $comment = new Comment;
        $comment->body = $request->input('body');
        $comment->post_id = $request->input('thepostid');
        $comment->user_id = auth()->user()->id;
        $comment->save();

        $post = Post::find($comment->post_id);
        $comments = Comment::where('post_id',$comment->post_id)->get();
        return view('posts.show')->with(['post'=>$post,'comments'=>$comments]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        // Check for current user
        if(auth()->user()->id !== $comment->user_id && auth()->user()->admin !== 1) {
            return redirect('/posts')->with('error','Unauthorized page');
        }
        // return view('comments.edit')->with('comment', $comment);

        return view('comments.edit')->with('comment',$comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);

        // Create Post
        $comment = Comment::find($id);
        $comment->body = $request->input('body');
        $comment->save();

        $post = Post::find($comment->post_id);
        $comments = Comment::where('post_id',$comment->post_id)->get();

        return view('posts.show')->with(['post'=>$post,'comments'=>$comments, 'success'=>'Post Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $comment = Comment::find($id);
        $oldPostID = $comment->post_id;

        if(auth()->user()->id !== $comment->user_id && auth()->user()->admin !== 1) {
            return redirect('/posts')->with('error','Unauthorized page');
        }
        $comment->delete();

        $post = Post::find($oldPostID);
        $comments = Comment::where('post_id',$oldPostID)->get();
        return view('posts.show')->with(['post'=>$post,'comments'=>$comments, 'success'=>'Comment Removed']);
    }
}
