<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabanKuisionerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban_kuisioner', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_jawaban_kuisioner', 25)->unique();
            $table->string('nama_jawaban_kuisioner', 200);
            $table->text('definisi_jawaban_kuisioner')->nullable();
            $table->double('bobot_jawaban_kuisioner', 8, 2);

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
        Schema::dropIfExists('jawaban_kuisioner');
    }
}
