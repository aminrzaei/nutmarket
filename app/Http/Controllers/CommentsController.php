<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Photo;
use App\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('admin.comments.index', compact('comments'));
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {   
        $user = Auth::user();
        $data = [
            'post_id' => $request->post_id,
            'body' => $request->body,
            'author' => $user->name,
            'email' => $user->email,
            'author_photo' => $user->photo->name,
        ];
        Comment::create($data);
        Session::flash('comment_msg', 'Thanks for your comment, please wait for moderate!');
        return redirect()->back();
    }

    public function show($id)
    {
        $comments = Post::findOrFail($id)->comments;
        return view('admin.comments.show', compact('comments'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        Comment::findOrFail($id)->update($request->all());
        return redirect()->back();
    }

    public function destroy($id)
    {
        Comment::findOrFail($id)->Delete();
        return redirect()->back();
    }
}
