<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Photo;

use Illuminate\Support\Facades\Session;

use App\Http\Requests\UsersCreateRequest;
use App\Http\Requests\UsersEditRequest;

use Illuminate\Http\Request;

class AdminUsersController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }


    public function store(UsersCreateRequest $request)
    {
        if(trim($request->password) == ''){
            $input = $request->except('password');
        }else{
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }
        
        $file = $request->file('user_profile');
        if($file){
            $name = time() . "_" . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['name'=>$name]);
            $input['photo_id'] = $photo->id;
        }
        
        $userName = $request->name;

        User::create($input);
        Session::flash('created_user_msg', 'The user "' . $userName . '" has been created!');
        return redirect('/admin/users');

        // $user = new User;
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->name = $request->name;
        // $user->password = $request->password;
        // $user->role_id = $request->role_id;
        // $user->is_active = $request->status;
        // $user->save();
    }
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.users.edit', compact('user','roles'));
    }


    public function update(UsersEditRequest $request, $id)
    {
        
        if(trim($request->password) == ''){
            $input = $request->except('password');
        }else{
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }
        $user = User::findOrFail($id);
        $file = $request->file('user_profile');
        if($file){
            $name = time() . "_" . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['name'=>$name]);
            $input['photo_id'] = $photo->id;
        }

        $user->update($input);
        Session::flash('updated_user_msg', 'The user "' . $user->name . '" has been updated!');
        return redirect('/admin/users');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if($user->photo){
            unlink(public_path() .  $user->photo->name);
        }
        if($user->posts){
            $posts = $user->posts->all();
            foreach($posts as $post){
                unlink(public_path() .  $post->photo->name);
                $photoId = $post->photo_id;
                Photo::findOrFail($photoId)->delete();
            }
        }

        $user->delete();
        $userPhotoId = $user->photo_id;
        Photo::findOrFail($userPhotoId)->delete();
        Session::flash('deleted_user_msg', 'The user "' . $user->name . '" has been deleted!');

        return redirect('/admin/users');
    }
}
