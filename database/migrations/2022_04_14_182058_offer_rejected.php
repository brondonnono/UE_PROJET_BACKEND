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
        Schema::create('offerRejected', function (Blueprint $table) {
            $table->increments('id', true)->unsigned();
            $table->integer('employe_id')->unsigned();
            $table->integer('offre_id')->unsigned();
            $table->timestamps();
            $table->foreign('employe_id')->references('id')->on('employes');
            $table->foreign('offre_id')->references('id')->on('offres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offerRejected');
    }
};
