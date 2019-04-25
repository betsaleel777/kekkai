<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes ;

class Ue extends Model
{
    use SoftDeletes ;
    protected $fillable =['libelle','filiere','ufr','niveau','nb_gr_cm','nb_gr_td','nb_gr_tp',
                        'heure_gr_cm','heure_gr_td','heure_gr_tp'] ;


}
