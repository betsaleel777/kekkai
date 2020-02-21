<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes ;

class Ue extends Model
{
    use SoftDeletes ;
    protected $fillable =['libelle','filiere','ufr','niveau','nb_gr_cm','nb_gr_td','nb_gr_tp',
                          'heure_gr_cm','heure_gr_td','heure_gr_tp'
                         ] ;

   const RULES = ['libelle' => 'required|max:170',
                         'filiere' => 'required',
                         'ufr' => 'required',
                         'niveau' => 'required',
                         'nb_gr_cm' => 'required|numeric',
                         'nb_gr_td' => 'required|numeric',
                         'nb_gr_tp' => 'required|numeric',
                         'heure_gr_cm'  => 'required|numeric',
                         'heure_gr_td'  => 'required|numeric',
                         'heure_gr_tp'  => 'required|numeric',
                  ] ;

   const MESSAGES = ['libelle.required' =>'le libellé est requis' ,
                     'libelle.max' => 'nombre maximal de caracter dépassé : 170',
                     'ufr.required' => 'le nom de l\'ufr est requis' ,
                     'niveau.required' => 'le niveau est requis',
                     'filiere.required' => 'la filière est requise',
                      'nb_gr_cm.required'  => 'nombre de groupe CM requis',
                      'nb_gr_td.required' => 'nombre de groupe TD requis' ,
                      'nb_gr_tp.required' => 'nombre de groupe TP requis' ,
                      'nb_gr_cm.numeric'  => 'nombre de groupe CM doit être composé de chiffre',
                      'nb_gr_td.numeric' => 'nombre de groupe TD doit être composé de chiffre' ,
                      'nb_gr_tp.numeric' => 'nombre de groupe TP doit être composé de chiffre' ,
                      'heure_gr_cm.required' => 'nombre d\'heures de CM est requis',
                      'heure_gr_td.required' => 'nombre d\'heures de TD est requis',
                      'heure_gr_tp.required' => 'nombre d\'heures de TP est requis',
                      'heure_gr_cm.numeric' => 'les heures de CM doivent être en chiffres!' ,
                      'heure_gr_td.numeric' => 'les heures de TD doivent être en chiffres!' ,
                      'heure_gr_tp.numeric' => 'les heures de TP doivent être en chiffres!' ,
                    ] ;

   public function setLibelleAttribute($value){
     $this->attributes['libelle'] = \mb_strtoupper($value) ;
   }

   public function setFiliereAttribute($value){
     $this->attributes['filiere'] = \mb_strtoupper($value) ;
   }

   public function setUfrAttribute($value){
     $this->attributes['ufr'] = \mb_strtoupper($value) ;
   }

   public function enseignants(){
     return $this->belongsToMany('App\Enseignant','assignations','ue_id','enseignant_id')->withPivot('cm','td','tp')->withTimestamps();
   }
}
