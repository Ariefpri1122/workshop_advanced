<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\se as se;

class ctrlntnx extends Controller
{
    //

    public function all()
    {
        //return se::all();

        $data = se::all();
        dd($data);
        //return view ('view_se')->with('data', $data);
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
