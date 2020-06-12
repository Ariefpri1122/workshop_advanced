<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modelntnx;

class ctrlntnx extends Controller
{
    //

    public function se ()
    {
        return ('Ini message dari controller');
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
