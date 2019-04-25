<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ue ;

class UesController extends Controller
{
    public function index()
    {
        $ues = Ue::get() ;
        return view('ues.index',compact('ues')) ;
    }

    public function add()
    {
        return view('ues.add') ;
    }

    public function insert(Request $request)
    {
    }

    public function edit(int $id)
    {
        $ue = Ues::findOrFail($id)->first() ;
        return view('ues.edit', compact('ue')) ;
    }

    public function update(Request $request)
    {
    }

    public function show(int $id)
    {
        $ue = Ues::findOrFail($id)->first() ;
        return view('ues.show', compact('ue')) ;
    }

    public function delete(int $id)
    {
    }

    public function trashed()
    {
    }
}
