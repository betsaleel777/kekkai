<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enseignant ;

class HomeController extends Controller
{
   public function welcome(){
     $title = 'Acceuil' ;
     return view('started',compact('title'));
   }

    public function open()
    {
        $title = 'Enseignants' ;
        $enseignants = Enseignant::get() ;
        return view('enseignants.index',compact('enseignants','title')) ;
    }
}
