<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nik_profile', 200);
            $table->integer('users_id')->unsigned();
            $table->integer('jabatan_id')->unsigned();

            $table->string('nama_profile', 200);
            $table->string('email_profile')->nullable();
            $table->text('alamat_profile');
            $table->string('nohp_profile', 35);
            $table->enum('jenis_kelamin_profile', ['L', 'P']);
            $table->string('gambar_profile', 200)->nullable();

            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('jabatan_id')->references('id')->on('jabatan')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile');
    }
}
