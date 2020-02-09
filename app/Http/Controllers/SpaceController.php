<?php

namespace App\Http\Controllers;

use App\Space;
use App\Efiewura;
use App\Location;
use App\Photo;
use App\Tag;
use App\User;
use App\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if(isset($request->cat)){
            switch ($request->cat) {
                case 'regions':
                    $space = Space::with(['location','photos','tags'])->get()->groupBy('location.region');
                    break;
                case 'towns':
                    $space = Space::with(['location','photos','tags'])->get()->groupBy('location.town');
                    break;
                case 'weeks':
                    $space = Space::with(['location','photos','tags'])->get()->groupBy(function ($val) {
                                    return Carbon::parse($val->created_at)->week();
                                });
                case 'months':
                    $space = Space::with(['location','photos','tags'])->get()->groupBy(function ($val) {
                                    return Carbon::parse($val->created_at)->format('m');
                                });
                    break;
                case 'popular':
                    $space = Tag::with('spaces')->orderBy('wa','desc')->get()->groupBy('name');
                    break;
                default:
                    $space = Space::all();
                    break;
            }  
        }else{
              $space = Space::all();
        }
        //var_dump($space);
        return response()->json($space,201);
    }

    public function search(Request $request)
    {
        //
        DB::enableQueryLog();
        $query = $request->q;
        $tags = explode(' ', $query);
        $search = Space::orWhereHas('tags',function($query) use($tags)
        {
            $query->where('name','like', '%'.$tags[0].'%');
           foreach ($tags as $tag) {
               $query->where('name','like', '%'.$tag.'%','or');
           }
        }, '>=', 1)->get();
        //var_dump($space);
        //  dd(DB::getQueryLog());
        return response()->json($search,201);
    }

     public function searchByFilter(Request $request, string $filter)
        {
        //
        DB::enableQueryLog();
        $queryArr = explode(',', $filter);
        $search = Space::with(['location','photos','tags','efiewura']);
        $i = 0;
        foreach ($queryArr as $value) {
            //dd($value);///= $this->filter($value)[0];
            preg_match('/([a-z_]+)(=|>|>=|<|<=|!=)([a-zA-Z0-9.]+)/', $value, $match);
            $val = isset($match[1])?$match[1]:'';
            if($val=='typ')
                $search = $search->where('type',$match[3]);
            if($val=='reg')
               $search = Space::whereHas('location',function($query) use($match)
                                {
                                    $query->where('region',$match[3]);
                                });
            if($val=='dst')
                $search = $search->whereHas('location',function($query) use($match)
                                {
                                    $query->where('district',$match[3]);
                                });
}
                /*case 'lat':
                $search = $search->whereHas('location',function($query) use($value)
                                {
                                    $query->where('latitude',$value[2],$value[3]);
                                });
                    break;
                case 'lng':
                $search = $search->whereHas('location',function($query) use($value)
                                {
                                    $query->where('longitude',$value[2],$value[3]);
                                });
                    break;
                case 'ef_nm':
                $search = $search->whereHas('efiewura',function($query) use($value)
                                {
                                    $query->where('name',$value[3]);
                                });
                    break;
                case 'ef_ph':
                $search = $search->whereHas('efiewura',function($query) use($value)
                                {
                                    $query->where('number',$value[3]);
                                });
                    break;
                case 'ef_ml':
                $search = $search->whereHas('efiewura',function($query) use($value)
                                {
                                    $query->where('email',$value[3]);
                                });
                    break;
                case 'ef_ad':
                $search = $search->whereHas('efiewura',function($query) use($value)
                                {
                                    $query->where('address',$value[3]);
                                });
                    break;*/
        if(isset($request->q)){
        $tags = explode(' ', $request->q);
        $search = $search->whereHas('tags',function($query) use($tags)
        {
            $query->where('name','like', '%'.$tags[0].'%');
           foreach (array_slice($tags,1) as $tag) {
               $query->where('name','like', '%'.$tag.'%','or');
           }
        }, '>=', 1)->get();
    }
        //var_dump($space);*/
       // dd($this->filter($filter));
        
      //dd(DB::getQueryLog());
        return response()->json($search,201);
    }

     public function indexOne(Space $space)
    {

        //
        //$space = Space::findofFail();
       // dd(DB::getQueryLog());
        return response()->json($space,201);
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
        /*$space = new Space;
        //$space->id = 40;
        $space->type = $request->type;
        $space->description = isset($request->description)? $request->description:'';
        $space->price = isset($request->price)? $request->price:0;
        $space->neg_flag = isset($request->neg_flag)? $request->neg_flag:1;
        $space->grant = 'jkw44w';//$request->grant;    
        $space->save();*/
        //dd($request->efiewura);
        return response()->json($request,201);
    }

    public function storeFull(Request $request)
    {
        $data = $request->json()->all();
            $efiewura = new Efiewura;
            $efiewura->name = $data['efiewura']['name'];
            $efiewura->number = $data['efiewura']['number'];
            $efiewura->email = (isset($data['efiewura']['email']))? $data['efiewura']['email']:"";
            //$efiewura->address = $data['efiewura']['address'];
            $efiewura->save();
            if(isset($data['efiewura']['photo'])){
                $profile = new Photo;
                $profile->etag = $data['efiewura']['photo']['etag'];
                $profile->location = $data['efiewura']['photo']['location'];
                $profile->entity()->associate($efiewura);
                $profile->save();
            }
            $location = new Location;
            $location->region = $data['location']['region'];
            $location->district = (isset($data['location']['district']))? $data['location']['district']:"";
            $location->town = $data['location']['town'];
            $location->save();
            $space = new Space;
            $space->type = $data['type'];
            $space->description = "A ".$space->type." located at ".$location->town." in the ".$this->region( $location->region)." with the following: ";
            $space->efiewura()->associate($efiewura);
            $space->location()->associate($location);
            $space->price = isset($data['price'])? $data['price']:0;
            $space->neg_flag = isset($data['negFlag'])? $data['negFlag']:1;
            $space->save();
            foreach ($data['photos'] as $val) {
                $photo = new Photo;
                $photo->etag = $val['etag'];
                $photo->location = $val['url'];
                $photo->entity()->associate($space);
                $photo->save();
            }
        foreach ($data['tags'] as $val) {
            if(isset($val->id)){
                $tag = Tag::find($val['id']);
            }
            else{
                $tag = new Tag;
                $tag->name = $val['name'];
                $tag->save();
            }

            $space->tags()->attach($tag);
        }
        return response()->json($space,201);
        
    }

    public function storeWithId(Request $request)
    {
        //
       $space = Space::firstOrNew(['id'=>$request->id]);
        if(!isset($space->created_at)){
            $space->id = $request->id;
            $space->type = $request->type;
            $space->description = isset($request->description)? $request->description:'';
            $space->price = isset($request->price)? $request->price:0;
            $space->neg_flag = isset($request->neg_flag)? $request->neg_flag:1;
            $space->grant = $request->grant;
            $space->save();
            return response()->json($space,201);
        }else{
            return response()->json('Exist Already',202);
        }
    }

    public function attachTag($tag_id, Space $space){
            $space->tags()->attach($val);
    }

    public function attachEfiewura($efiewura_id, Space $space){
            $efiewura = Efiewura::find($efiewura_id);
            $space->efiewura()->associate($efiewura)->save();
    }

    public function attachLocation($location_id, Space $space){
            $location = Location::find($location_id);
            $space->location()->associate($location)->save();
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Space  $space
     * @return \Illuminate\Http\Response
     */
    public function show(Space $space)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Space  $space
     * @return \Illuminate\Http\Response
     */
    public function edit(Space $space)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Space  $space
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Space $space)
    {
        //
        $data = $request->json()->all();
        if(isset($request->type))
        $space->type = $request->type;
        if(isset($request->description))
        $space->description = $request->description;
        if(isset($request->price))
        $space->price = $request->price;
        if(isset($request->neg_flag))
        $space->neg_flag = $request->neg_flag;
        if(isset($request->grant))
        $space->grant = $request->grant;
        if(isset($data['type']))
        $space->type = $data['type'];
        if(isset($data['description']))
        $space->description = $data['description'];
        if(isset($data['price']))
        $space->price = (int) $request->price;
        if(isset($data['negFlag']))
        $space->neg_flag = $data['negFlag'];
        if(isset($data['grant']))
        $space->grant = $data['grant'];
        if(isset($data['location']['region']))
        $space->location->region = $data['location']['region'];
        if(isset($data['location']['district']))
        $space->location->district = $data['location']['district'];
        if(isset($data['location']['town']))
        $space->location->town = $data['location']['town'];
        $space->location->save();
        if(isset($data['efiewura']['name']))
        $space->efiewura->name = $data['efiewura']['name'];
        if(isset($data['efiewura']['number']))
        $space->efiewura->number = $data['efiewura']['number'];
        if(isset($data['efiewura']['email']))
        $space->efiewura->email = $data['efiewura']['email'];
        $space->efiewura->save();
        $space->save();
        return response()->json($space,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Space  $space
     * @return \Illuminate\Http\Response
     */
    public function destroy(Space $space)
    {
        //
        $note = Space::destroy($space->id);
        if ($note) {
            return response()->json('Succesfully Deleted',201);
        }else{
            return response()->json('Not Found',404);
        }
    }

      public function apiShow($val)
    {
        $user = Space::all();
        return response()->json($val.' has ID of ',201);
    }

    private function filter($str){
        $arr = explode(',', $str);
        $filterArr = array();
        foreach ($arr as $value) {
            preg_match('/([a-z_]+)(=|>|>=|<|<=|!=)([a-zA-Z0-9.]+)/', $value, $match);
            array_push($filterArr, $match);
        }
        return $filterArr;
    }
    private function region($str){
        return "Greater Accra";
    }

}
