<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB ;
use App\Ue ;
use PDF ;

class UesController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }

    public function index()
    {   $title = 'Unités d\'enseignements' ;
        $ues = Ue::get() ;
        return view('ues.index', compact('ues','title')) ;
    }

    public function add()
    {
        $title = 'Ajouter UES' ;
        return view('ues.add',compact('title')) ;
    }

    public function insert(Request $request)
    {
        $this->validate($request, UE::RULES,UE::MESSAGES);
        $ue = new Ue($request->all()) ;
        $ue->save() ;
        $message = 'l\'unité d\'enseignement <strong>'.$request->libelle.'</strong> a été enregistré avec succès !!' ;
        return redirect()->route('ues_index')->with('success', $message)->withInput() ;
    }

    public function edit(int $id)
    {
        $ue = Ue::findOrFail($id) ;
        $title = 'Modifier '.$ue->libelle ;
        return view('ues.edit', compact('ue','title')) ;
    }

    public function update(Request $request, int $id)
    {
        $ue = Ue::findOrFail($id) ;
        $this->validate($request, UE::RULES,UE::MESSAGES);
        $ue->update($request->all()) ;
        $message = 'l\'unité d\'enseignement <strong>'.$request->libelle.'</strong> a été modifié avec succès !!' ;
        return redirect()->route('ues_index')->with('success', $message) ;
    }

    public function show(int $id)
    {
        $ue = Ue::findOrFail($id) ;
        $title = 'Détails '.$ue->libelle ;
        $enseignant_sans_repetition = DB::select("SELECT sum(assignations.cm) as cm ,sum(assignations.td) as td,sum(assignations.tp) as tp,enseignants.id,
                                      enseignants.nomination from assignations inner join enseignants on enseignants.id=assignations.enseignant_id
                                      where assignations.ue_id=? group by enseignants.id",[$id]) ;
        $cm = 0 ;
        $td = 0 ;
        $tp = 0 ;
        foreach ($enseignant_sans_repetition as $enseignant){
            $cm += $enseignant->cm ;
            $td += $enseignant->td ;
            $tp += $enseignant->tp ;
        }
        $rest = ['cm' => $ue->heure_gr_cm-$cm ,
                 'td' => $ue->heure_gr_td-$td ,
                 'tp' => $ue->heure_gr_tp-$tp
                ] ;
        $total = [ 'cm' => $cm, 'td' => $td, 'tp' => $tp] ;
        return view('ues.show', compact('ue','total','enseignant_sans_repetition','rest','title')) ;
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
        $title = 'Archives UES' ;
        $ues = Ue::onlyTrashed()->get() ;
        return view('ues.archives', compact('ues','title')) ;
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

    public function generatePdf(){
      $ues = Ue::with('enseignants')->get()->all() ;
      $ue_infos = [] ;
      foreach ($ues as $ue) {
      array_push($ue_infos, [
                'libelle' => $ue->libelle,
                'filiere' => $ue->filiere,
                'niveau' => $ue->niveau,
                'ufr' => $ue->ufr,
                'heure_gr_cm' => $ue->heure_gr_cm,
                'heure_gr_td' => $ue->heure_gr_td,
                'heure_gr_tp' => $ue->heure_gr_tp,
               ]) ;
      }

      $ues_sans_repetition = \array_map(function($ue){
        $enseignants = $ue->enseignants->groupBy('nomination')->all() ;
        $marmite = [] ;
        $cm = null ; $td = null ; $tp = null ;
        $count = 0 ;
        foreach ($enseignants as $enseignant) {
          $cm = 0 ; $td = 0 ; $tp = 0 ;
          $calebasse = [] ;
          if(count($enseignant) > 1){
            $nomination = null ;
            foreach ($enseignant as $elt) {
              $nomination = $elt->nomination ;
              $cm += $elt->pivot->cm ;
              $td += $elt->pivot->td ;
              $tp += $elt->pivot->tp ;
            }
            $calebasse = [ 'nomination' => $nomination,
                           'cm' => $cm,
                           'td' => $td,
                           'tp' => $tp,
                         ];
          }else{
            $calebasse = ['nomination' => $enseignant[0]->nomination,
                           'cm' => $enseignant[0]->pivot->cm,
                           'td' => $enseignant[0]->pivot->td,
                           'tp' => $enseignant[0]->pivot->tp,
                         ];
          }
          array_push($marmite,$calebasse) ;
        }
        return $marmite ;
      },$ues) ;
      $title = 'liste de répartition' ;
      $data = [
                'ue_infos' => $ue_infos,
                'ues_sans_repetition' => $ues_sans_repetition,
                'title' => $title
              ] ;
      $pdf = PDF::loadView('ues.expdf', $data);
      return  $pdf->stream(time().'list.pdf',["Attachment" => false]) ;
    }
}
