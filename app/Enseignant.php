<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes ;

class Enseignant extends Model
{
    use SoftDeletes ;
    const TITRES_ABREGE = ['Mr' => ['AUCUN'],
                           'Dr' => ['MA','MC','A'],
                           'Pr' => ['PT']
                          ] ;
    const TITRES = [ 'Mr' =>'SANS TITRE' ,'Pr' =>'PROFESSEUR','Dr' =>'DOCTEUR' ] ;

    protected $fillable = ['nomination','grade','statut','email','phone','titre'] ;
    const MESSAGES = ['cm.required' => 'le temps assigné au CM est obligatoire' ,
                      'cm.required' => 'veuillez renseigner une valeure numerique',
                      'td.required' => 'le temps assigné au td est requis',
                      'td.numeric' =>  'veuillez renseigner une valeure numerique',
                      'tp.required' => 'le temps assigné au tp est requis',
                      'tp.numeric' => 'veuillez renseigner une valeure numerique',
                      'ue_id' => 'le choix de l\'UE est obligatoire',
                      'enseignant_id' => 'le choix de l\'enseignant est obligatoire',  
                     ] ;

    public function setNominationAttribute($value){
      $this->attributes['nomination']= mb_strtoupper($value) ;
    }

    public function setTitreAttribute($value){
      foreach (self::TITRES_ABREGE as $key => $data){
        if(in_array($this->attributes['grade'],$data)){
          $this->attributes['titre'] = $key ;
        }
      }
    }

    public function ues(){
          return $this->belongsToMany('App\Ue', 'assignations', 'enseignant_id', 'ue_id')->withPivot('cm','td','tp')->withTimestamps();
    }
}
