<?php

namespace App\Http\Controllers;

use App\Country;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreUser $request)
    {
        $data = $request->all();
        $user = User::create($data);
        $user->roles()->attach($data['roles']);
        return redirect(route('users.index'));
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
        return view('edit', compact(['user','countries', 'roles', 'user_roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUser $request, User $user)
    {
        $data = $request->all();
        if (!empty($data)) {
            $user->roles()->sync($data['roles']);
            $user->update($data);
            return redirect(route('users.index'));
        }
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
