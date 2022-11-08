<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminMediasController extends Controller
{
    public function index()
    {
        $photos = Photo::all();
        return view('admin.medias.index', compact('photos'));
    }

    public function create()
    {
        return view('admin.medias.create');
    }
    public function store(Request $request)
    {
        $file = $request->file('filepond');
        $name = time() . '_' . $file->getClientOriginalName();
        $file->move('images', $name);
        Photo::create(['name' => $name]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        unlink(public_path() .  $photo->name);
        $photo->delete();
        Session::flash('deleted_img_msg', 'The Post "' . $photo->name . '" has been deleted!');
        return redirect('/medias/manage');
    }
    public function manage(Request $request)
    {
        $photos = Photo::all();
        return view('admin.medias.manage', compact('photos'));
    }

}
