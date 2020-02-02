<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $locations = Location::all();
        return response()->json($locations,201);
    }

     public function indexOne(Location $location)
    {
        //
        //$space = Space::findofFail();
        return response()->json($location,201);
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
        $location = new Location;
        $location->region = $request->region;
        $location->district = isset($request->district)? $request->district:'';
        $location->town = $request->town;
        $location->longitude = isset($request->lng)? $request->lng:0.000;
        $location->latitude = isset($request->lat)? $request->lat:0.0000;
        $location->save();
        return response()->json($location,201);
    }

    public function storeWithId(Request $request, Location $location)
    {
        //
        $location = new Location;
        $location->region = $request->region;
        $location->district = isset($request->district)? $request->district:'';
        $location->town = $request->town;
        $location->longitude = isset($request->lng)? $request->lng:0.000;
        $location->latitude = isset($request->lat)? $request->lat:0.0000;
        $location->save();
        return response()->json($location,201);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        //
        if(isset($request->region))
        $location->region = $request->region;
        if(isset($request->district))
        $location->district = $request->district;
        if(isset($request->town))
        $location->town = $request->town;
        if(isset($request->lng))
        $location->longitude =  $request->lng;
        if(isset($request->lat))
        $location->latitude =  $request->lat;
        $location->save();
        return response()->json($location,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        //
        $note = Location::destroy($location->id);
        if ($note) {
            return response()->json('Succesfully Deleted',201);
        }else{
            return response()->json('Not Found',404);
        }
    
    }
}
