<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modelntnx;
use App\se;

class ctrlntnx extends Controller
{
    //

    public function all()
    {
        return se::all();
    }

    public function show($id)
    {
        return se::find($id);
    }
    
    /*
    public function se(modelntnx $modelntnx)
    {
        $this->modelntnx = $modelntnx->list_se();
        $data = $this->modelntnx;

        return view ('view_se')->with('data',$data);
    }
    */
}
