<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('employes', function (Blueprint $table) {
            $table->increments('id', true)->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('nom');
            $table->char('sexe', 1);
            $table->timestamp('DateNais');
            $table->text('formations');
            $table->text('competences');
            $table->string('villeResidence');
            $table->string('cv');
            $table->string('avatar');
            $table->timestamps();
        
            $table->engine = 'InnoDB';
        });
        
        Schema::connection('mysql')->table('employes', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->drop('employes');
    }
};

