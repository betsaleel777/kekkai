<?php

namespace App\Http\Controllers;

use App\Enseignant;
use App\Ue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AssignationsController extends Controller
{
    public function index()
    {   //desactiver le stric mode de mysql pour faire fonctionner les requette laeavel comme celle de phpmyadmin
        $title = 'Assignations' ;
        $assignements = DB::table('assignations')
            ->select(DB::raw('enseignants.id,enseignants.nomination,enseignants.titre,ues.id as ue,ues.libelle,ues.filiere,ues.niveau,assignations.cm,assignations.td,assignations.tp'))
            ->join('ues', 'assignations.ue_id', '=', 'ues.id')
            ->join('enseignants', 'assignations.enseignant_id', '=', 'enseignants.id')
            ->get()->toArray();
        return view('assignations.index', compact('assignements','title'));
    }

    public function add()
    {
        $title = 'Assignation Multiple' ;
        $enseignants = Enseignant::get();
        $ues = Ue::get();
        return view('assignations.add', compact('enseignants', 'ues', 'title'));
    }

    public function addSimple()
    {
        $title = 'Simple Assignation' ;
        $enseignants = Enseignant::get();
        $ues = Ue::get();
        return view('assignations.simple', compact('enseignants', 'ues','title'));
    }

    public function insert(Request $request)
    {
        $errors = [] ;
        $data = json_decode($request->data, true);

        if (empty($data)) {
            array_push($errors, 'aucune assignations d\'UE détectée !') ;
        }
        if(empty($request->enseignant_id)) {
            array_push($errors, 'Vous devez selectioner un enseignant !') ;
        }

        if (!empty($errors)) {
            return Response::json(['errors' => $errors,'data' => $request->data]) ;
        } else {
            $toAssign = [];
            foreach ($data as $value) {
                [$ue, $cm, $td, $tp] = $value;
                $tab = [$ue, $cm, $td, $tp] ;
                //mapper ce tableau pour verifier si une seule valeure est négative non entière ou vide

                $toAssign = $toAssign + [$ue => ["cm" => (int)$cm, "td" => (int)$td, "tp" => (int)$tp]];
            }
            $enseignant = Enseignant::findOrFail($request->enseignant_id);
            $enseignant->ues()->attach($toAssign);

            return Response::json(['success' => ["cm" => $cm, "td" => $td, "tp" => $tp] ], 200);
        }
    }

    public function simpleInsert(Request $request){
        return response()->json([$request->all()]) ;
    }

    public function edit($id, $ue)
    {
        $title = 'Modification d\'assignation' ;
        $enseignants = Enseignant::get() ;
        $enseignant = Enseignant::findOrFail($id);
        $ues = Ue::get() ;
        $ue_link = $enseignant->ues()->findOrFail($ue) ;
        return view('assignations.edit', compact('enseignant', 'enseignants', 'ue_link', 'ues','title'));
    }

    public function update(Request $request, $id, $ue)
    {
        $enseignant = Enseignant::findOrFail($id);
        $this->validate($request, ['cm' => 'required|numeric',
            'td' => 'required|numeric',
            'tp' => 'required|numeric',
            'enseignant_id' => 'required',
            'ue_id' => 'required'], Enseignant::MESSAGES);

        $ue_link = $enseignant->ues()->find($ue) ;

        $ue_link->pivot->ue_id = $request->ue_id ;
        $ue_link->pivot->cm = $request->cm ;
        $ue_link->pivot->td = $request->td ;
        $ue_link->pivot->tp = $request->tp ;
        $ue_link->pivot->save() ;

        $message = '<p>modification d\'heure a été effectuée avec succès !!</p>
                    <ul>
                     <li><strong>CM => '.$request->cm.'</strong></li>
                     <li><strong>TD => '.$request->td.'</strong></li>
                     <li><strong>TP => '.$request->tp.'</strong></li>
                    </ul>';
        return redirect()->route('assignations_index')->with('success', $message);
    }

    public function delete(int $id, $ue)
    {
        $enseignant = Enseignant::findOrFail($id);
        $ue_link = $enseignant->ues()->find($ue) ;
        $ue_link->pivot->delete() ;
        $message = 'l\'unité d\'enseignement <strong>'.$ue_link->libelle.'</strong> assignée à <strong>'.$enseignant->titre.' '.$enseignant->nomination.'</strong> vient d\'être archivée' ;
        return redirect()->route('assignations_index')->with('success', $message) ;
    }
}
