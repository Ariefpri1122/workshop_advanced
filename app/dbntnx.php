<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dbntnx extends Model
{
    protected $array = ['arief','agung','yogi'];

    public function f_data()
    {
        return $this->array;
    }
}
