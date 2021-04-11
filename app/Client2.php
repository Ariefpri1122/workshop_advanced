<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client2 extends Model
{
    //
    protected $connection = 'pgsql2';
    protected $table = 'clients';

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }
}
