<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('assignations', function (Blueprint $table) {
             $table->bigIncrements('id');
             $table->unsignedSmallInteger('cm') ;
             $table->unsignedSmallInteger('td')->nullable() ;
             $table->unsignedSmallInteger('tp')->nullable() ;
             $table->unsignedBigInteger('enseignant_id')->index() ;
             $table->unsignedBigInteger('ue_id')->index();
             $table->foreign('enseignant_id')->references('id')->on('enseignants')->onDelete('cascade') ;
             $table->foreign('ue_id')->references('id')->on('ues')->onDelete('cascade') ;
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
        Schema::dropIfExists('assignations');
    }
}
