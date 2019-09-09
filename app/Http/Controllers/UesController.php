<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ue ;

class UesController extends Controller
{
    public function index()
    {
        $ues = Ue::get() ;
        return view('ues.index', compact('ues')) ;
    }

    public function add()
    {
        return view('ues.add') ;
    }

    public function insert(Request $request)
    {
        $this->validate($request, ['libelle' => 'required|max:170',
                              'filiere' => 'required',
                              'ufr' => 'required',
                              'niveau' => 'required',
                              'nb_gr_cm' => 'required|numeric',
                              'nb_gr_td' => 'required|numeric',
                              'nb_gr_tp' => 'required|numeric',
                              'heure_gr_cm'  => 'required|numeric',
                              'heure_gr_td'  => 'required|numeric',
                              'heure_gr_tp'  => 'required|numeric', ]);
        $ue = new Ue($request->all()) ;
        $ue->save() ;
        $message = 'l\'unité d\'enseignement <strong>'.$request->libelle.'</strong> a été enregistré avec succès !!' ;
        return redirect()->route('ues_index')->with('success', $message) ;
    }

    public function edit(int $id)
    {
        $ue = Ue::findOrFail($id) ;
        return view('ues.edit', compact('ue')) ;
    }

    public function update(Request $request, int $id)
    {
        $ue = Ue::findOrFail($id) ;
        $this->validate($request, ['libelle' => 'required|max:170',
                              'filiere' => 'required',
                              'ufr' => 'required',
                              'niveau' => 'required',
                              'nb_gr_cm' => 'required|numeric',
                              'nb_gr_td' => 'required|numeric',
                              'nb_gr_tp' => 'required|numeric',
                              'heure_gr_cm'  => 'required|numeric',
                              'heure_gr_td'  => 'required|numeric',
                              'heure_gr_tp'  => 'required|numeric', ]);
        $ue->update($request->all()) ;
        $message = 'l\'unité d\'enseignement <strong>'.$request->libelle.'</strong> a été modifié avec succès !!' ;
        return redirect()->route('ues_index')->with('success', $message) ;
    }

    public function show(int $id)
    {
        $ue = Ue::findOrFail($id) ;
        return view('ues.show', compact('ue')) ;
    }

    public function delete(int $id)
    {
        $ue = Ue::findOrFail($id) ;
        $ue->delete() ;
        $message = 'l\'unité d\'enseignement <strong>'.$ue->libelle.'</strong> vient d\'être archivée avec succès' ;
        return redirect()->route('ues_index')->with('info',$message) ;
    }

    public function trashed()
    {
        $ues = Ue::onlyTrashed()->get() ;
        return view('ues.archives', compact('ues')) ;
    }

    public function restore(int $id)
    {
        $ue = Ue::withTrashed()->findOrFail($id) ;
        $ue->restore();
        $message = 'l\'unité d\'enseignement <strong>'.$ue->libelle.'</strong> vient d\'être restaurée des archives' ;
        return redirect()->route('ues_index')->with('info',$message) ;
    }

    public function purge(int $id)
    {
        $ue = Ue::withTrashed()->findOrFail($id) ;
        $ue->forceDelete() ;
        $message = 'l\'unité d\'enseignement <strong>'.$ue->libelle.'</strong> vient définitivement supprimée des archives' ;
        return redirect()->route('ues_trashed')->with('success',$message) ;
    }
}
