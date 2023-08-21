<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendukungTpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendukung_tps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tps_id')->unsigned();
            $table->integer('users_id')->unsigned();

            $table->integer('users_id_koordinator')->nullable();
            $table->string('pendukungcoblos_tps')->nullable();
            $table->boolean('verificationcoblos_tps')->nullable();
            $table->boolean('tps_status')->nullable()->default(0);
            $table->string('tps_coblos')->nullable();

            $table->foreign('tps_id')->references('id')->on('tps')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('pendukung_tps');
    }
}
