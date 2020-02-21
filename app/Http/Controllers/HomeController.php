<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;
use App\Enseignant ;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

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

    public function deconnexion(){
      Auth::logout() ;
      return redirect('/') ;
    }
}
