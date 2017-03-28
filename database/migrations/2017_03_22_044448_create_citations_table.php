<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitationsTable extends Migration
{

    public function up()
    {
        Schema::create('citations', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('specialty_id')->unsigned();
            $table->foreign('specialty_id')->references('id')->on('specialties');
            $table->integer('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('users');
            $table->integer('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('id')->on('users');
            $table->date('citation_date');
            $table->string('remark');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['specialty_id','patient_id','citation_date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('citations');
    }
}
