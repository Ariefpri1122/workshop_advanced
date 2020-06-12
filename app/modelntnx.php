<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class modelntnx extends Model
{
    //
    protected $array=['Arief','Petrus','Duga','Yogi','Agung','Sahdam','Halim','Yudi','Jojo'];

    public function list_se()
    {
        return $this->array;
    }
}
