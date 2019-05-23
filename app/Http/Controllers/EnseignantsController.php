<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enseignant ;

class EnseignantsController extends Controller
{
    public function index()
    {
        $enseignants = Enseignant::get() ;
        return view('enseignants.index', compact('enseignants')) ;
    }

    public function add()
    {
        return view('enseignants.add') ;
    }

    public function insert(Request $request)
    {
        $this->validate($request,['nomination' => 'required|max:170',
                                'statut' => 'required',
                                'grade' => 'required',
                                'email' => 'required|unique:enseignants',
                                'phone' => 'required|numeric|unique:enseignants',]);

        $enseignant = new Enseignant($request->all()) ;
        $enseignant->save() ;
        $message = 'l\'enseignant <b>'.$request->nomination.'</b> a été enregistré avec succès !!' ;
        return redirect()->route('enseignant_index')->with('success',$message) ;
    }

    public function edit($id)
    {
        $enseignant = Enseignant::findOrFail($id) ;
        return view('enseignants.edit', compact('enseignant')) ;
    }

    public function update(Request $request,$id)
    {
      $enseignant = Enseignant::findOrFail($id) ;
      $this->validate($request,['nomination' => 'required|max:170',
                              'statut' => 'required',
                              'grade' => 'required',
                              'email' => 'required|unique:enseignants,email,'.$enseignant->id,
                              'phone' => 'required|numeric|unique:enseignants,phone,'.$enseignant->id
                             ]);

      $enseignant->nomination = $request->nomination ;
      $enseignant->statut = $request->statut ;
      $enseignant->grade = $request->grade ;
      $enseignant->email = $request->email ;
      $enseignant->phone = $request->phone ;
      $enseignant->titre = $request->titre ;
      $enseignant->save() ;
      $message = 'l\'enseignant <strong>'.$request->nomination.'</strong> a été modifié avec succès !!' ;
      return redirect()->route('enseignant_index')->with('success',$message) ;
    }

    public function show($id)
    {
        $enseignant = Enseignant::findOrFail($id) ;
        return view('enseignants.show', compact('enseignant')) ;
    }

    public function delete(int $id)
    {
        $enseignant = Enseignant::findOrFail($id) ;
        $enseignant->delete() ;
        $message = 'l\'enseignant <strong>'.$enseignant->nomination.'</strong> a été archivé' ;
        return redirect()->route('enseignant_index')->with('info',$message) ;
    }

    public function trashed()
    {
      $enseignants = Enseignant::onlyTrashed()->get() ;
      return view('enseignants.archives',compact('enseignants')) ;
    }

    public function restore(int $id){
      $enseignant = Enseignant::withTrashed()->findOrFail($id) ;
      $enseignant->restore() ;
      $message = 'l\'enseignant <strong>'.$enseignant->nomination.'</strong> a été restauré des archives' ;
      return redirect()->route('enseignant_index')->with('info',$message) ;
    }

    public function purge(int $id){
      $enseignant = Enseignant::withTrashed()->findOrFail($id) ;
      $enseignant->forceDelete() ;
      $message = 'l\'enseignant <strong>'.$enseignant->nomination.'</strong> a été définitivement supprimé' ;
      return redirect()->route('enseignant_trashed')->with('success',$message) ;
    }

    public function infos(Request $request){
      $enseignant = Enseignant::with('ues')->findOrFail($request->input('teacher')) ;
      $cm = 0 ;
      $td = 0 ;
      $tp = 0 ;
      foreach ($enseignant->ues as $ue) {
        $cm += $ue->pivot->cm ;
        $td += $ue->pivot->td ;
        $tp += $ue->pivot->tp ;
      }
      return response()->json(
        ['enseignant' => $enseignant,
         'total' => ['cm' => $cm, 'td' => $td, 'tp' => $tp]
        ]) ;
    }
}
