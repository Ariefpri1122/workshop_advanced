<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client3 extends Model
{
    //
    protected $connection = 'pgsql3';
    protected $table = 'clients';

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }
}
