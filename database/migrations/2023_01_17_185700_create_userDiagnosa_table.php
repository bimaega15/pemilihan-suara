<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDiagnosaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_diagnosa', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal_user_diagnosa');
            $table->string('judul_user_diagnosa', 200);
            $table->text('nama_user_diagnosa');
            $table->enum('jenis_kelamin_user_diagnosa', ['L', 'P']);
            $table->string('nomor_hp_user_diagnosa', 50);
            $table->string('email_user_diagnosa', 200)->nullable();
            $table->text('alamat_user_diagnosa');
            $table->string('usia_user_diagnosa', 20);
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
        Schema::dropIfExists('user_diagnosa');
    }
}
