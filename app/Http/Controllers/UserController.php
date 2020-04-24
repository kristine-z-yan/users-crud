<?php

namespace App\Http\Controllers;

use App\Country;
use App\cr;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::with(['roles','country'])->paginate(15);
//        dd($users[0]->country->name);
        return view('index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $countries = Country::all();
        $roles = Role::all();
        return view('store', compact(['countries', 'roles']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->data;
        $user = User::create($data);
        $user->roles()->attach($data['roles']);
        return response('created', 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $countries = Country::all();
        $roles = Role::all();
        foreach($user->roles as $role)
        {
            $user_roles[] = $role->id;
        }
//        dd($user);
        return view('edit', compact(['user','countries', 'roles', 'user_roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $data = $request->data;
        $user->roles()->sync($data['roles']);
        $user->update($data);
        return response('updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user){
            $user->delete();
            return response('deleted', 200);
        };
    }
}
