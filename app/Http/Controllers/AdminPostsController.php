<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Photo;
use App\Post;
use App\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostEditRequest;

class AdminPostsController extends Controller
{

    public function index()
    {
        // $posts = Post::all();
        $posts = Post::paginate(2);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categoreis = Category::all();
        return view('admin.posts.create', compact('categoreis'));
    }

    public function store(PostCreateRequest $request)
    {
        $user = Auth::user();
        $input = $request->all();
        $file = $request->file('post_picture');

        $input['user_id'] = $user->id;
        if($file){
            $name = time() . "_" . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['name'=>$name]);
            $input['photo_id'] = $photo->id;
        }

        $postTitle = $request->title;

        Post::create($input);
        Session::flash('created_post_msg', 'The Post "' . $postTitle . '" has been created!');
        return redirect('/admin/posts');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categoreis = Category::all();
        return view('admin.posts.edit', compact('categoreis', 'post'));
    }

    public function update(PostEditRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        $input = $request->all();
        $file = $request->file('post_picture');

        if($file){
            $name = time() . "_" . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['name'=>$name]);
            $input['photo_id'] = $photo->id;
        }

        $post->update($input);
        Session::flash('updated_post_msg', 'The Post "' . $post->title . '" has been updated!');
        return redirect('/admin/posts');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        unlink(public_path() .  $post->photo->name);
        $photoId = $post->photo_id;
        Photo::findOrFail($photoId)->delete();
        

        Session::flash('deleted_post_msg', 'The Post "' . $post->title . '" has been deleted!');
        return redirect('/admin/posts');
    }

    public function post($slug)
    {
        $post = Post::findBySlugOrFail($slug);
        // $post = Post::where('slug', $slug)->first();
        $postComments = $post->comments->where('is_active', 1);
        return view('post', compact('post', 'postComments'));
    }

    public function search(Request $request){
        $searchInput = $request->q;
        $posts = Post::where('title', 'LIKE', '%'.$searchInput.'%')->get();
        return $posts;
    }
}
