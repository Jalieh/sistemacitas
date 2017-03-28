<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration
{

    public function up()
    {
        Schema::table('users', function(Blueprint $table){
            $table->engine = 'InnoDB';

            $table->integer('specialty_id')->unsigned()->after('password')->nullable();
            $table->foreign('specialty_id')->references('id')->on('specialties');
        });
    }


    public function down()
    {
        Schema::table('users', function(Blueprint $table){
            $table->dropForeign('users_specialty_id_foreign');
            $table->dropColumn('specialty_id');
        });
    }
}
