<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provinces_id')->unsigned();
            $table->integer('regencies_id')->unsigned();
            $table->integer('districts_id')->unsigned();
            $table->integer('villages_id')->unsigned();
            $table->string('nama_tps', 50);
            $table->text('alamat_tps');
            $table->integer('totallk_tps')->nullable();
            $table->integer('totalpr_tps')->nullable();
            $table->integer('totalsemua_tps')->nullable();
            $table->string('users_id')->nullable();
            $table->integer('minimal_tps');
            $table->integer('target_tps');
            $table->integer('kuota_tps');
            $table->timestamps();


            $table->foreign('provinces_id')->references('id')->on('provinces')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('regencies_id')->references('id')->on('regencies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('districts_id')->references('id')->on('districts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('villages_id')->references('id')->on('villages')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tps');
    }
}
