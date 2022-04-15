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
        Schema::create('offres', function (Blueprint $table) {
            $table->increments('id', true)->unsigned();
            $table->integer('employeur_id')->unsigned();
            $table->string('libelle');
            $table->text('description');
            $table->timestamp('dateExpiration');
            $table->string('posteVise');
            $table->text('competencesRequises');
            $table->string('typeOffre');
            $table->timestamps();
            $table->foreign('employeur_id')->references('id')->on('employeurs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offres');
    }
};
