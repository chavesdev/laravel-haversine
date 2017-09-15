<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class GenericModel extends Model
{

	public function scopeLocation(Builder $query, $latitude, $longitude, $radius = 10){
		    $haversine = '( 3959 * acos( cos( radians('.$latitude.') ) *
			         cos( radians( latitude ) )
			         * cos( radians( longitude ) - radians('.$longitude.')
			         ) + sin( radians('.$latitude.') ) *
			         sin( radians( latitude ) ) )
			       ) AS distance';

		    $where =   "ROUND(( 10  * 3956 * acos( cos( radians('$latitude') ) * "
					  . "cos( radians(latitude) ) * "
					  . "cos( radians(longitude) - radians('$longitude') ) + "
					  . "sin( radians('$latitude') ) * "
					  . "sin( radians(latitude) ) ) ) ,8) <=". $radius
					  .' and latitude IS NOT NULL';

		   return $query->select('generics.*')
			  ->selectRaw($haversine)
			  ->whereRaw($where);

	}

}
