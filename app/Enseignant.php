<?php

namespace App;

use Illuminate\Database\Eloquent\Model ;
use Illuminate\Database\Eloquent\SoftDeletes ;

class Enseignant extends Model
{
    use SoftDeletes ;
    protected $fillable = ['nomination','grade','statut','email','phone','titre'] ;

    const TITRES_ABREGE = ['Mr' => ['AUCUN'],
                           'Dr' => ['MA','MC','A'],
                           'Pr' => ['PT']
                          ] ;
    const TITRES = [ 'Mr' =>'SANS TITRE' ,'Pr' =>'PROFESSEUR','Dr' =>'DOCTEUR' ] ;

    const MESSAGES = [ 'nomination.required' => 'le nom est requis' ,
                 'nomination.max' => 'nombre maximale de caractère dépassé:170' ,
                 'statut.required' => 'le statut est requis' ,
                 'grade.required' => 'le grade est requis',
                 'email.required' => 'l\'email est requis ',
                 'email.unique' =>  'cet email est déjà utilisé',
                 'phone.required' => 'le téléphone est requis' ,
                 'phone.numeric' => 'le téléphone ne doit contenir que des chiffres',
                 'phone.unique' => 'ce numéro de téléphone est déjà utilisé',
                ] ;

    public function setNominationAttribute($value){
      $this->attributes['nomination'] = mb_strtoupper($value) ;
    }

    public function setTitreAttribute($value){
      foreach (self::TITRES_ABREGE as $key => $data){
        if(in_array($this->attributes['grade'],$data)){
          $this->attributes['titre'] = $key ;
        }
      }
    }

    public function ues(){
          return $this->belongsToMany('App\Ue', 'assignations', 'enseignant_id', 'ue_id')
                      ->withPivot('cm','td','tp')
                      ->withTimestamps();
    }


    public static function regles(int $id=null){
      return ['nomination' => 'required|max:170',
              'statut' => 'required',
              'grade' => 'required',
              'email' => 'required|unique:enseignants,email,'.$id,
              'phone' => 'required|numeric|unique:enseignants,phone,'.$id
             ] ;

    }
}
