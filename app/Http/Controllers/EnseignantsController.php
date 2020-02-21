<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB ;
use App\Enseignant ;
use PDF ;

class EnseignantsController extends Controller
{
    public function index()
    {
        $enseignants = Enseignant::get() ;
        $title = 'Enseignants' ;
        // dd(DB::select("SELECT sum(assignations.cm) as cm ,sum(assignations.td) as td,sum(assignations.tp) as tp,ues.id,ues.libelle from assignations
        //       inner join ues on ues.id=assignations.ue_id where assignations.enseignant_id=? group by ues.id",[2]));
        return view('enseignants.index', compact('enseignants','title')) ;
    }

    public function add()
    {
        $title = 'Ajouter Enseignant' ;
        return view('enseignants.add',compact('title')) ;
    }

    public function insert(Request $request)
    {
        $this->validate($request,Enseignant::regles(),Enseignant::MESSAGES);

        $enseignant = new Enseignant($request->all()) ;
        $enseignant->save() ;
        $message = 'l\'enseignant <b>'.$request->nomination.'</b> a été enregistré avec succès !!' ;
        return redirect()->route('enseignant_index')->with('success', $message)->withInput() ;
    }

    public function edit($id)
    {
        $enseignant = Enseignant::findOrFail($id) ;
        $title = 'Modifier '.$enseignant->nomination ;
        return view('enseignants.edit', compact('enseignant','title')) ;
    }

    public function update(Request $request, $id)
    {
        $enseignant = Enseignant::findOrFail($id) ;
        $this->validate($request,Enseignant::regles($enseignant->id),Enseignant::MESSAGES) ;

        $enseignant->nomination = $request->nomination ;
        $enseignant->statut = $request->statut ;
        $enseignant->grade = $request->grade ;
        $enseignant->email = $request->email ;
        $enseignant->phone = $request->phone ;
        $enseignant->titre = $request->titre ;
        $enseignant->save() ;
        $message = 'l\'enseignant a été modifié avec succès !!' ;
        return redirect()->route('enseignant_index')->with('success', $message)  ;
    }

    public function show($id)
    {
        $enseignant = Enseignant::findOrFail($id) ;
        $title = $enseignant->nomination ;
        $ues_sans_repetition = (array)DB::select("SELECT sum(assignations.cm) as cm ,sum(assignations.td)
                                as td,sum(assignations.tp) as tp,ues.id,ues.libelle from assignations
                                inner join ues on ues.id=assignations.ue_id where assignations.enseignant_id=?
                                group by ues.id",[$id]) ;
        $cm = 0 ;
        $td = 0 ;
        $tp = 0 ;
        foreach ($ues_sans_repetition as $ue){
            $cm += $ue->cm ;
            $td += $ue->td ;
            $tp += $ue->tp ;
        }
        $total = [ 'cm' => $cm, 'td' => $td, 'tp' => $tp] ;
        return view('enseignants.show', compact('enseignant','ues_sans_repetition','total','title')) ;
    }

    public function delete(int $id)
    {
        $enseignant = Enseignant::findOrFail($id) ;
        $enseignant->delete() ;
        $message = 'l\'enseignant <strong>'.$enseignant->nomination.'</strong> a été archivé' ;
        return redirect()->route('enseignant_index')->with('info', $message) ;
    }

    public function trashed()
    {   $title ='Archives Enseignant' ;
        $enseignants = Enseignant::onlyTrashed()->get() ;
        return view('enseignants.archives', compact('enseignants','title')) ;
    }

    public function restore(int $id)
    {
        $enseignant = Enseignant::withTrashed()->findOrFail($id) ;
        $enseignant->restore() ;
        $message = 'l\'enseignant <strong>'.$enseignant->nomination.'</strong> a été restauré des archives' ;
        return redirect()->route('enseignant_index')->with('info', $message) ;
    }

    public function purge(int $id)
    {
        $enseignant = Enseignant::withTrashed()->findOrFail($id) ;
        $enseignant->forceDelete() ;
        $message = 'l\'enseignant <strong>'.$enseignant->nomination.'</strong> a été définitivement supprimé' ;
        return redirect()->route('enseignant_trashed')->with('success', $message) ;
    }

    public function infos(Request $request)
    {
        $enseignant = Enseignant::with('ues')->findOrFail($request->input('teacher')) ;
        $enseignant_sans_repetition = DB::select("SELECT sum(assignations.cm) as cm ,sum(assignations.td) as td,sum(assignations.tp) as tp,ues.id,ues.libelle from assignations
                                      inner join ues on ues.id=assignations.ue_id where assignations.enseignant_id=? group by ues.id",[$request->input('teacher')]) ;
        $cm = 0 ;
        $td = 0 ;
        $tp = 0 ;
        foreach ($enseignant->ues as $ue){
            $cm += $ue->pivot->cm ;
            $td += $ue->pivot->td ;
            $tp += $ue->pivot->tp ;
        }
        return response()->json(
        ['enseignant' => $enseignant_sans_repetition,
         'total' => ['cm' => $cm, 'td' => $td, 'tp' => $tp]
        ]
        ) ;
    }

    public function generatePdf(){
        $enseignants = Enseignant::with('ues')->get() ;
        $enseignants_sans_repetition = [] ;

        foreach ($enseignants as $enseignant) {
          $calebasse = DB::select("SELECT sum(assignations.cm) AS cm ,sum(assignations.td) AS td,sum(assignations.tp) AS tp,ues.id,ues.libelle FROM assignations
                        INNER JOIN ues ON ues.id=assignations.ue_id WHERE assignations.enseignant_id=? GROUP BY ues.id",[$enseignant->id]) ;
          $jarre = ['infos' => $enseignant ,'ues' => $calebasse] ;
          array_push($enseignants_sans_repetition,$jarre) ;
        }
        /**nous pourrons améliorer ensuite la requette en effectuant une procedure stocké qui vas recevoir
           comme parametre la liste des id des enseignant et qui retournera en une seule fois les ues
           sans repetition dans un gros jeu de resultat
        **/
        $title = 'liste d\'assignation' ;
        $data = [
                  'enseignants_sans_repetition' => $enseignants_sans_repetition,
                  'title' => $title
                ];
        $pdf = PDF::loadView('enseignants.expdf', $data);
        // return $pdf->download(time().'list.pdf');
        return  $pdf->stream(time().'list.pdf',["Attachment" => false]) ;
    }

    public function getList(){
      $enseignants = Enseignant::get() ;
      return response()->json(['enseignants' => $enseignants]) ;
    }

    public function getInfos(int $id){
      $enseignant = Enseignant::findOrfail($id) ;
      return response()->json(['enseignant' => $enseignant]) ;
    }
}
