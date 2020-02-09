<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return response()->json($users,201);
    }

     public function indexOne(User $user)
    {
        //
        //$space = Space::findofFail();
        return response()->json($user,201);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = new User;
        $user->grant = isset($request->grant)? $request->grant:'';
        $user->email = isset($request->email)? $request->email:'';
        $user->number = isset($request->number)? $request->number:'';
        $user->platform = isset($request->platform)? $request->platform:0;
        $data = $request->json()->all()
        $user->grant = isset($data['name'])? $data['name']:'';
        $user->email = isset($data['email'])? $data['email']:'';
        $user->number = isset($data['number'])? $data['number']:'';
        $user->platform = isset($data['platform'])? $data['platform']:0;
        $user->save();
        return response()->json($user,201);
    }

    public function storeWithId(Request $request, User $user)
    {
        //
        $user = new User;
        $user->grant = $request->name;
        $user->email = isset($request->email)? $request->email:'';
        $user->number = isset($request->number)? $request->number:'';
        $user->platform = isset($request->platform)? $request->platform:0;
        $user->save();
        return response()->json($user,201);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        if(isset($request->name))
        $user->grant = $request->name;
        if(isset($request->email))
        $user->email = $request->email;
        if(isset($request->number))
        $user->number = $request->number;
        if(isset($request->platform))
        $user->platform = $request->platform;
        $user->save();
        return response()->json($user,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $note = User::destroy($user->id);
        if ($note) {
            return response()->json('Succesfully Deleted',201);
        }else{
            return response()->json('Not Found',404);
        }
    }
}
