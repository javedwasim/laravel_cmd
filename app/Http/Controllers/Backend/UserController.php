<?php

namespace App\Http\Controllers\Backend;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserDestroyRequest;
use Illuminate\Support\Facades\Hash;


class UserController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name')->paginate($this->limit);
        $userCount = user::count();

        return view('admin.users.index',compact('users','userCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new user();
        return view('admin.users.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
       $user =  User::create([
                    'name'=>$request['name'],
                    'email'=>$request['email'],
                    'bio'=>$request['bio'],
                    'password'=>Hash::make($request['password']),
                ]);
        $user->attachRole($request['role']);

        return redirect('admin/users')->with('message',"New user has been created.");
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
        $user = User::findOrFail($id);

        return view('admin.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
       $user =  User::findOrFail($id);
       $user->name = $request['name'];
       $user->email = $request['email'];
       $user->bio = $request['bio'];
       $user->password = Hash::make($request['password']);
       $user->save();

        $user->detachRoles();
        $user->attachRole($request['role']);

        return redirect('admin/users')->with('message',"User has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDestroyRequest $request,$id)
    {
        $user = User::findOrFail($id);
        $deleteOption = $request->delete_option;
        $selectedUser = $request->selected_user;

        if($deleteOption == 'delete'){
            $user->posts()->withTrashed()->forceDelete();
        }
        elseif($deleteOption == 'attribute'){
            $user->posts()->update(['author_id'=>$selectedUser]);
        }
        //$user->delete();

        return redirect('admin/users')->with('message',"User has been deleted.");
    }

    public function confirm(UserDestroyRequest $request,$id)
    {
        $user = User::findOrFail($id);
        $users = User::where('id','!=',$user->id)->pluck('name','id');

        return view('admin.users.confirm',compact('user','users'));
    }
}
