<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $photos = Photo::all();
        return response()->json($photos,201);
    }

     public function indexOne(Photo $photo)
    {
        //
        //$space = Space::findofFail();
        return response()->json($photo,201);
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
        $photo = new Photo;
        $photo->etag = $request->region;
        $photo->location = $request->location;
        $photo->save();
        return response()->json($photo,201);
    }

    public function storeWithId(Request $request, Photo $photo)
    {
        //
        $photo = new Photo;
        $photo->etag = $request->region;
        $photo->location = $request->location;
        $photo->save();
        return response()->json($photo,201);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        //
        if(isset($request->etag))
        $photo->etag = $request->etag;
        if(isset($request->location))
        $photo->location = $request->location;
        $photo->save();
        return response()->json($photo,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        //
        $note = Photo::destroy($photo->id);
        if ($note) {
            return response()->json('Succesfully Deleted',201);
        }else{
            return response()->json('Not Found',404);
        }
    }
}
