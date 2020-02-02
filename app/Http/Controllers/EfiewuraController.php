<?php

namespace App\Http\Controllers;

use App\Efiewura;
use App\Photo;
use Illuminate\Http\Request;

class EfiewuraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $efiewura = Efiewura::all();
        return response()->json($efiewura,201);
        
    }

     public function indexOne(Efiewura $efiewura)
    {
        //
        //$space = Space::findofFail();
        return response()->json($efiewura,201);
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
        $efiewura = new Efiewura;
        $efiewura->name = $request->name;
        $efiewura->email = isset($request->email)? $request->email:'';
        $efiewura->number = isset($request->number)? $request->number:'';;
        $efiewura->save();
        return response()->json($efiewura,201);
    }

    public function storeWithImage(Request $request)
    {
        //
        $efiewura = new Efiewura;
        $efiewura->name = $request->name;
        $efiewura->email = isset($request->email)? $request->email:'';
        $efiewura->number = isset($request->number)? $request->number:'';
        $photo = Photo::find($request->photo_id);
        $efiewura->photos()->save($photo);
        $efiewura->save();
        return response()->json($efiewura,201);
    }

    public function addImage(Request $request, Efiewura $Efiewura)
    {
        //
        $photo = Photo::find($request->photo_id);
        $efiewura->photos()->save($photo);
        $efiewura->save();
        return response()->json($efiewura,201);
    }

    public function storeWithId(Request $request)
    {
        //
       $efiewura = Efiewura::firstOrNew(['id'=>$request->id]);
        if(!isset($efiewura->created_at)){
            $efiewura->id = $request->id;
            $efiewura->name = $request->name;
            $efiewura->email = isset($request->email)? $request->email:'';
            $efiewura->number = isset($request->number)? $request->number:'';
            $efiewura->save();
            return response()->json($efiewura,201);
        }else{
            return response()->json('Exist Already',202);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Efiewura  $efiewura
     * @return \Illuminate\Http\Response
     */
    public function show(Efiewura $efiewura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Efiewura  $efiewura
     * @return \Illuminate\Http\Response
     */
    public function edit(Efiewura $efiewura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Efiewura  $efiewura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Efiewura $efiewura)
    {
        //
        if(isset($request->name))
        $efiewura->name = $request->name;
        if(isset($request->email))
        $efiewura->email = $request->email;
        if(isset($request->number))
        $efiewura->number = $request->number;
        $efiewura->save();
        return response()->json($efiewura,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Efiewura  $efiewura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Efiewura $efiewura)
    {
        //
        $note = Efiewura::destroy($efiewura->id);
        if ($note) {
            return response()->json('Succesfully Deleted',201);
        }else{
            return response()->json('Not Found',404);
        }
    
    }
}
