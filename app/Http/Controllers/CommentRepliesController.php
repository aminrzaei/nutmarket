<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentReply;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommentRepliesController extends Controller
{
    public function index()
    {
        $commentReplies = CommentReply::all();
        return view('admin.comments.replies.index', compact('commentReplies'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $commentReplies = Comment::findOrFail($id)->replies;
        return view('admin.comments.replies.show', compact('commentReplies'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        CommentReply::findOrFail($id)->update($request->all());
        return redirect()->back();
    }

    public function destroy($id)
    {
        CommentReply::findOrFail($id)->Delete();
        return redirect()->back();
    }

    public function createReply(Request $request){
        $user = Auth::user();
        $data = [
            'comment_id' => $request->comment_id,
            'body' => $request->body,
            'author' => $user->name,
            'email' => $user->email,
            'author_photo' => $user->photo->name
        ];
        CommentReply::create($data);
        Session::flash('comment_reply_msg', 'Thanks for your comment, please wait for moderate!');
        return redirect()->back();
    }
}
