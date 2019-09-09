<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('libelle',170) ;
            $table->string('filiere',80) ;
            $table->string('ufr',80) ;
            $table->string('niveau',20) ;
            $table->tinyInteger('nb_gr_cm') ;
            $table->tinyInteger('nb_gr_td') ;
            $table->tinyInteger('nb_gr_tp') ;
            $table->smallInteger('heure_gr_cm') ;
            $table->smallInteger('heure_gr_td') ;
            $table->smallInteger('heure_gr_tp') ;
            $table->softDeletes() ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ues');
    }
}
