<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipeMedicinesTable extends Migration
{

    public function up()
    {
        Schema::create('recipe_medicines', function(Blueprint $table){
            $table->engine = 'InnoDB';

            $table->integer('recipe_id')->unsigned();
            $table->integer('medicine_id')->unsigned();

            $table->foreign('recipe_id')->references('id')->on('record_recipes')->onDelete('cascade');
            $table->foreign('medicine_id')->references('id')->on('medicines')->onDelete('cascade');

            $table->primary(['recipe_id','medicine_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('recipe_medicines');
    }
}
