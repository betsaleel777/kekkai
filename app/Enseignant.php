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
