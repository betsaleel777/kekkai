<?php

namespace App\Http\Controllers;

use App\Ue ;
use App\Enseignant ;
use Illuminate\Http\Request ;
use Illuminate\Support\Facades\DB ;

class AjaxController extends Controller
{
    public function verify_cm(Request $request)
    {
        //verifier si cm+ancien ne depasse pas total
        $error_message = null ;
        $message = null ;

        $ue = Ue::with('enseignants')->findOrFail($request->input('ue')) ;
        $deja_assigne = 0 ;

        //calcul du total des heures de cm déjà assignées
        foreach ($ue->enseignants as $enseignant) {
            $deja_assigne += $enseignant->pivot->cm ;
        }

        $total_a_assigner = $ue->heure_gr_cm ;
        $rest = $total_a_assigner - $deja_assigne ;
        $virtual_rest = $total_a_assigner - ($deja_assigne + (int)$request->input('test')) ;

        if ($virtual_rest>0) {
            $message = $message = $virtual_rest.' peuvent être assignées' ;
        } elseif ($virtual_rest === 0) {
            $message = 'nombre maximum d\'heures atteint' ;
        } else {
            $error_message = 'incorrecte!! Il reste '.$rest.' heures.' ;
        }
        return response()->json(['message' => $message , 'error' => $error_message ]) ;
    }

    public function verify_td(Request $request)
    {
        //verifier si td+ancien ne depasse pas total
        $error_message = null ;
        $message = null ;

        $ue = Ue::with('enseignants')->findOrFail($request->input('ue')) ;
        $deja_assigne = 0 ;

        //calcul du total des heures de td déjà assignées
        foreach ($ue->enseignants as $enseignant) {
            $deja_assigne += $enseignant->pivot->td ;
        }

        $total_a_assigner = $ue->heure_gr_td ;
        $rest = $total_a_assigner - $deja_assigne ;
        $virtual_rest = $total_a_assigner - ($deja_assigne + (int)$request->input('test')) ;

        if ($virtual_rest>0) {
            $message = $message = $virtual_rest.' peuvent être assignées .' ;
            ;
        } elseif ($virtual_rest === 0) {
            $message = 'nombre maximum d\'heures atteint' ;
        } else {
            $error_message = 'incorrecte!! Il reste '.$rest.' heures.' ;
        }
        return response()->json(['message' => $message , 'error' => $error_message ]) ;
    }

    public function verify_tp(Request $request)
    {
        $error_message = null ;
        $message = null ;
        $ue = Ue::with('enseignants')->findOrFail($request->input('ue')) ;
        $deja_assigne = 0 ;
        //calcul du total des heures de tp déjà assignées
        foreach ($ue->enseignants as $enseignant) {
            $deja_assigne += $enseignant->pivot->tp ;
        }

        //verifier si tp+ancien ne depasse pas total
        $total_a_assigner = $ue->heure_gr_tp ;
        $rest = $total_a_assigner - $deja_assigne ;
        $virtual_rest = $total_a_assigner - ($deja_assigne + (int)$request->input('test')) ;

        if ($virtual_rest>0) {
            $message = $virtual_rest.' peuvent être assignées' ;
        } elseif ($virtual_rest === 0) {
            $message = 'nombre maximum d\'heures atteint';
        } else {
            $error_message = 'incorrecte!! Il reste '.$rest.' heures.' ;
        }
        return response()->json(['message' => $message , 'error' => $error_message ]) ;
    }

    public function check_cm(int $test,int $ue){
      //verifier si cm+ancien ne depasse pas total
      $error_message = null ;
      $message = null ;
      $ue = Ue::with('enseignants')->findOrFail($ue) ;
      $deja_assigne = 0 ;
      //calcul du total des heures de cm déjà assignées
      foreach ($ue->enseignants as $enseignant) {
          $deja_assigne += $enseignant->pivot->cm ;
      }

      $total_a_assigner = $ue->heure_gr_cm ;
      $rest = $total_a_assigner - $deja_assigne ;
      $virtual_rest = $total_a_assigner - ($deja_assigne + (int)$test) ;

      if ($virtual_rest>0) {
          $message = $message = $virtual_rest.' peuvent être assignées' ;
      } elseif ($virtual_rest === 0) {
          $message = 'nombre maximum d\'heures atteint' ;
      } else {
          $error_message = 'incorrecte!! Il reste '.$rest.' heures.' ;
      }
      return response()->json(['message' => $message , 'error' => $error_message ]) ;
    }

    public function check_td(int $test,int $ue){
      //verifier si td+ancien ne depasse pas total
      $error_message = null ;
      $message = null ;
      $ue = Ue::with('enseignants')->findOrFail($ue) ;
      $deja_assigne = 0 ;
      //calcul du total des heures de td déjà assignées
      foreach ($ue->enseignants as $enseignant) {
          $deja_assigne += $enseignant->pivot->td ;
      }

      $total_a_assigner = $ue->heure_gr_td ;
      $rest = $total_a_assigner - $deja_assigne ;
      $virtual_rest = $total_a_assigner - ($deja_assigne + (int)$test) ;

      if ($virtual_rest>0) {
          $message = $message = $virtual_rest.' peuvent être assignées .' ;
      } elseif ($virtual_rest === 0) {
          $message = 'nombre maximum d\'heures atteint' ;
      } else {
          $error_message = 'incorrecte!! Il reste '.$rest.' heures.' ;
      }
      return response()->json(['message' => $message , 'error' => $error_message ]) ;
    }

    public function check_tp(int $test,int $ue){
      $error_message = null ;
      $message = null ;

      $ue = Ue::with('enseignants')->findOrFail($ue) ;
      $deja_assigne = 0 ;
      //calcul du total des heures de tp déjà assignées
      foreach ($ue->enseignants as $enseignant) {
          $deja_assigne += $enseignant->pivot->tp ;
      }
      //verifier si tp+ancien ne depasse pas total
      $total_a_assigner = $ue->heure_gr_tp ;
      $rest = $total_a_assigner - $deja_assigne ;
      $virtual_rest = $total_a_assigner - ($deja_assigne + (int)$test) ;

      if ($virtual_rest>0) {
          $message = $virtual_rest.' peuvent être assignées' ;
      } elseif ($virtual_rest === 0) {
          $message = 'nombre maximum d\'heures atteint';
      } else {
          $error_message = 'incorrecte!! Il reste '.$rest.' heures.' ;
      }
      return response()->json(['message' => $message , 'error' => $error_message ]) ;
    }

    public function assign(int $ue,int $ens,int $cm,int $td,int $tp){
      $enseignant = Enseignant::findOrFail($ens) ;
      $matiere = Ue::findOrFail($ue);
      $toAssign = [$ue => ['cm' => $cm ,'td' => $td ,'tp'=> $tp]] ;
      $enseignant->ues()->attach($toAssign) ;
      $message = 'a été assignéé à l\'enseignant '.$enseignant->nomination.' l\'UE: '.$matiere->libelle.', les heures suivantes:
                  "CM" =>'.$cm.'H "TD" =>'.$td.'H TP =>'.$tp.'H .' ;
      return response()->json(['message' => $message]) ;
    }

    public function getListEnseignant(){
      $enseignants = Enseignant::get() ;
      return response()->json(['enseignants' => $enseignants]) ;
    }

    public function getListUe(){
      $ues = Ue::get() ;
      return response()->json(['ues' => $ues]) ;
    }

    public function getTeacherOf(int $id){
      $ue = Ue::findOrFail($id) ;
      $enseignants = DB::select("SELECT sum(assignations.cm) as cm ,sum(assignations.td) as td,sum(assignations.tp) as tp,enseignants.id,
                                    enseignants.nomination from assignations inner join enseignants on enseignants.id=assignations.enseignant_id
                                    where assignations.ue_id=? group by enseignants.id",[$id]) ;
      $cm = 0 ;
      $td = 0 ;
      $tp = 0 ;
      foreach ($enseignants as $enseignant){
          $cm += $enseignant->cm ;
          $td += $enseignant->td ;
          $tp += $enseignant->tp ;
      }
      $rest = ['cm' => $ue->heure_gr_cm-$cm ,
               'td' => $ue->heure_gr_td-$td ,
               'tp' => $ue->heure_gr_tp-$tp
              ] ;
      $total = [ 'cm' => $cm, 'td' => $td, 'tp' => $tp] ;
      return response()->json(['ue' => $ue,'total' => $total, 'enseignants'=>$enseignants, 'rest'=> $rest]) ;
    }

    public function getInfos(int $id){
      $enseignant = Enseignant::findOrfail($id) ;
      return response()->json(['enseignant' => $enseignant]) ;
    }
}
