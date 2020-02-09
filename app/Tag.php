<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //

	public function spaces()
	{
		return $this -> belongsToMany('App\Space');
	}
}
