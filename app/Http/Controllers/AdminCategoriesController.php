<?php

namespace App\Http\Controllers;

use App\Category;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CategoryRequest;

class AdminCategoriesController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->all());
        $categoryName = $request->name;
        Session::flash('created_category_msg', 'The Post "' . $categoryName . '" has been created!');
        return redirect('/admin/categories');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
    }


    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        Session::flash('updated_category_msg', 'The Post "' . $category->name . '" has been updated!');
        return redirect('/admin/categories');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        
        $posts = $category->posts;
        if($posts){
            foreach($posts as $post){
                unlink(public_path() .  $post->photo->name);
                $photoId = $post->photo_id;
                Photo::findOrFail($photoId)->delete();
            }
        }
        $category->delete();
        
        Session::flash('deleted_category_msg', 'The Post "' . $category->name . '" has been deleted!');
        return redirect('/admin/categories');
    }
}
