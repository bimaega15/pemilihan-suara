<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePernyataanDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pernyataan_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kuisioner_id')->unsigned();
            $table->integer('jawaban_kuisioner_id')->unsigned();
            $table->integer('pernyataan_id')->unsigned();

            $table->timestamps();

            $table->foreign('kuisioner_id')->references('id')->on('kuisioner')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('jawaban_kuisioner_id')->references('id')->on('jawaban_kuisioner')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pernyataan_id')->references('id')->on('pernyataan')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pernyataan_detail');
    }
}
