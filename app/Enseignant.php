<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes ;

class Enseignant extends Model
{
    use SoftDeletes ;
    const GRADES = ['AUCUN' => 'sans grade' ,
                    'A' => 'assistant',
                    'MA' => 'maître assistant',
                    'MC' => 'maître de conférence',
                    'PT' =>'professeur titulaire'] ;
    const TITRES_ABREGE = ['Mr' => ['AUCUN'],
                           'Dr' => ['MA','MC','A'],
                           'Pr' => ['PT']
                          ] ;
    const TITRES = [ 'Mr' =>'SANS TITRE' ,'Pr' =>'PROFESSEUR','Dr' =>'DOCTEUR' ] ;

    protected $fillable = ['nomination','grade','statut','email','phone','titre'] ;

    public function getNominationAttribute($value){
      return strtoupper($value) ;
    }

    public function getGradeAttribute($value){
      $value = self::GRADES[$value] ;
      return strtoupper($value) ;
    }

    public function getStatutAttribute($value){
      return strtoupper($value) ;
    }

    public function setTitreAttribute($value){
      foreach (self::TITRES_ABREGE as $key => $data){
        if(in_array($this->attributes['grade'],$data)){
          $this->attributes['titre'] = $key ;
        }
      }
    }
}
