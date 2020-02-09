<?php

namespace App\Http\Controllers;

use App\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sessions = Session::all();
        return response()->json($sessions,201);
    }

     public function indexOne(Session $session)
    {
        //
        //$space = Space::findofFail();
        return response()->json($session,201);
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
        $session = new Session;
        $session->token = $request->token;
        $session->endtime = isset($request->endtime)? $request->endtime:'';
        $session->save();
        return response()->json($session,201);
    }

    public function storeWithId(Request $request, Session $session)
    {
        //
        $session = new Session;
        $session->token = $request->token;
        $session->endtime = isset($request->endtime)? $request->endtime:'';
        $session->save();
        return response()->json($session,201);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        //
        if(isset($request->token))
        $session->token = $request->token;
        if(isset($request->endtime))
        $session->endtime = $request->endtime;
        $session->save();
        return response()->json($session,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        //
        $note = Session::destroy($session->id);
        if ($note) {
            return response()->json('Succesfully Deleted',201);
        }else{
            return response()->json('Not Found',404);
        }
    }
}
