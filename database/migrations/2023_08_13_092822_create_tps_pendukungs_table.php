<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTpsPendukungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tps_pendukung', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tps_detail_id')->unsigned();
            $table->integer('users_id_koordinator')->unsigned();
            $table->integer('users_id_pendukung')->unsigned();
            $table->integer('tps_id')->unsigned();
            $table->timestamps();

            $table->foreign('tps_detail_id')->references('id')->on('tps_detail')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('users_id_koordinator')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('users_id_pendukung')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tps_id')->references('id')->on('tps')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tps_pendukung');
    }
}
