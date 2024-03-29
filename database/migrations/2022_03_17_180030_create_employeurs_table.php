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
        Schema::connection('mysql')->create('employeurs', function (Blueprint $table) {
            $table->increments('id', true)->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('nom');
            $table->text('description');
            $table->text('Secteur_activité');
            $table->string('ville');
            $table->timestamps();
        
            $table->engine = 'InnoDB';
        });
        Schema::connection('mysql')->table('employeurs', function (Blueprint $table) {
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
        Schema::connection('mysql')->drop('employeurs');
    }
};

