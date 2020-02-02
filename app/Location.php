<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    
	public function space()
	{
 		return $this->hasOne('App\Space');
	}
}
