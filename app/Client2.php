<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //

    protected $connection = 'pgsql2'; 
    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }
}
