<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
	
    protected $with = ['efiewura','location','photos','tags'];
    protected $fillable = ['name','grant'];
    //
	public function efiewura()
	{
	    return $this->belongsTo('App\Efiewura');
	}
	public function location()
	{
	    return $this->belongsTo('App\Location');
	}
	public function photos()
	{
		return $this->morphMany('App\Photo', 'entity');
	}
	public function tags()
	{
		return $this->belongsToMany('App\Tag');
	}
}
