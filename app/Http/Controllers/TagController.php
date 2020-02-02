<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tags = Tag::all();
        return response()->json($tags,201); 
    }

     public function indexOne(Tag $tag)
    {
        //
        //$space = Space::findofFail();
        return response()->json($tag,201);
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
        $tag = new Tag;
        $tag->name = $request->name;
        $tag->wa = isset($request->wa)? $request->wa:0.00;
        $tag->save();
        return response()->json($tag,201);
    }

    public function storeWithId(Request $request, Tag $tag)
    {
        //
        $tag = new Tag;
        $tag->name = $request->name;
        $tag->wa = isset($request->wa)? $request->wa:0.00;
        $tag->save();
        return response()->json($tag,201);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        //
        if(isset($request->name))
        $tag->name = $request->name;
        if(isset($request->wa))
        $tag->wa = $request->wa;
        $tag->save();
        return response()->json($tag,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
        $note = Tag::destroy($tag->id);
        if ($note) {
            return response()->json('Succesfully Deleted',201);
        }else{
            return response()->json('Not Found',404);
        }
    }

    public function search(Request $request)
    {
        //
        DB::enableQueryLog();
        $query = $request->q;
        $search = null;
        if($query!=null)
        $search = Tag::where('name','like', '%'.$query.'%')->get();

        //var_dump($space);
        //  dd(DB::getQueryLog());
        return response()->json($search,201);
    }

    public function townSearch(Request $request)
    {
        //
        DB::enableQueryLog();
        $query = $request->q;
        $search = null;
        if($query!=null)
        $search = Tag::where('name','like', '%'.$query.'%')
                        ->whereRaw('`name` in (select `town` from `locations`)')
                        ->get();
        else
           $search = Tag::whereRaw('`name` in (select `town` from `locations`)')
                        ->get(); 

        //var_dump($space);
        //  dd(DB::getQueryLog());
        return response()->json($search,201);
    }
}
