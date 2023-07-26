<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hasil_id')->unsigned();
            $table->integer('kuisioner_id')->unsigned();
            $table->integer('jawaban_kuisioner_id')->unsigned();
            $table->timestamps();

            $table->foreign('hasil_id')->references('id')->on('hasil')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kuisioner_id')->references('id')->on('kuisioner')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('jawaban_kuisioner_id')->references('id')->on('jawaban_kuisioner')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hasil_detail');
    }
}
