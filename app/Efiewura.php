<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Efiewura extends Model
{
    use SoftDeletes;
    //
    protected $with = ['photo'];
	public function space()
	{
 		return $this->hasOne('App\Space');
	}
	public function photo()
	{
		return $this->morphOne('App\Photo', 'entity');
	}
}
