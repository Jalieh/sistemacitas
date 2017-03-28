<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordRecipesTable extends Migration
{

    public function up()
    {
        Schema::create('record_recipes', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('record_id')->unsigned();
            $table->foreign('record_id')->references('id')->on('records');
            $table->enum('status', ['up', 'delivered', 'cancelled']);
            $table->text('observations', 300);
            $table->integer('pharmacist_id')->unsigned()->nullable();
            $table->foreign('pharmacist_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('record_recipes');
    }
}
