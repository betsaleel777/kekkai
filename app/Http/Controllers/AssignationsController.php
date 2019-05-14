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
    { //desactiver le stric mode de mysql pour faire fonctionner les requette laeavel comme celle de phpmyadmin
        $assignements = DB::table('assignations')
            ->select(DB::raw('assignations.id,enseignants.nomination,ues.libelle,ues.niveau,assignations.cm,assignations.td,assignations.tp'))
            ->join('ues', 'assignations.ue_id', '=', 'ues.id')
            ->join('enseignants', 'assignations.enseignant_id', '=', 'enseignants.id')
            ->get()->toArray();
        return view('assignations.index', compact('assignements'));
    }

    public function add()
    {
        $enseignants = Enseignant::get();
        $ues = Ue::get();
        return view('assignations.add', compact('enseignants', 'ues'));
    }

    public function insert(Request $request)
    {
        $rules = ['enseignant_id' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Response::json(['errors' => $validator->getMessageBag()->toArray()], 400);
        }

        $data = json_decode($request->data, true);
        $toAssign = [];
        foreach ($data as $value) {
            [$ue, $cm, $td, $tp] = $value;
            $toAssign = $toAssign + [$ue => ["cm" => $cm, "td" => $td, "tp" => $tp]];
        }
        $enseignant = Enseignant::findOrFail($request->enseignant_id);
        $enseignant->ues()->attach($toAssign);

        return Response::json(['success' => $toAssign], 200);
    }

    public function edit($id)
    {
        $enseignant = Enseignant::findOrFail($id);
        return view('assignations.edit', compact('assignement'));
    }

    public function update(Request $request, $id)
    {
        $enseignant = Enseignant::findOrFail($id);
        $this->validate($request, ['nomination' => 'required|max:170',
            'statut' => 'required',
            'grade' => 'required',
            'email' => 'required|unique:assignations,email,' . $enseignant->id,
            'phone' => 'required|numeric|unique:assignations,phone,' . $enseignant->id]);

        $message = 'l\'assignation a été enregistré avec succès !!';
        noty($message);
        return redirect()->route('assignations_index');
    }

    public function show($id)
    {
        $enseignant = Enseignant::findOrFail($id)->first();
        return view('assignations.show', compact('enseignant'));
    }

    public function delete(int $id)
    {
        $enseignant = Enseignant::findOrFail($id);
        $enseignant->delete();
        return redirect()->route('enseignant_index');
    }

    public function trashed()
    {
        $assignements = Enseignant::onlyTrashed()->get();
        return view('assignations.archives', compact('assignations'));
    }

    public function restore(int $id)
    {
        $enseignant = Enseignant::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('enseignant_index');
    }

    public function purge(int $id)
    {
        $enseignant = Enseignant::withTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('enseignant_trashed');
    }
}
