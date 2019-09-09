<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enseignant ;

class HomeController extends Controller
{
    public function open()
    {
        $enseignants = Enseignant::get() ;
        return view('enseignants.index',compact('enseignants')) ;
    }
}
