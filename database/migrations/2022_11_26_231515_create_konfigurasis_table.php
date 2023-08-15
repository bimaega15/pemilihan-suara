<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonfigurasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konfigurasi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cominimal_konfigurasi');
            $table->integer('volminimal_konfigurasi');
            $table->string('nama_konfigurasi', 200);
            $table->string('logo_konfigurasi', 250);
            $table->string('nohp_konfigurasi', 200);
            $table->text('alamat_konfigurasi');
            $table->string('email_konfigurasi')->unique()->nullable();
            $table->text('deskripsi_konfigurasi')->nullable();
            $table->string('facebook_konfigurasi')->nullable();
            $table->string('instagram_konfigurasi')->nullable();
            $table->string('youtube_konfigurasi')->nullable();
            $table->string('created_konfigurasi');
            $table->string('longitude_konfigurasi', 200);
            $table->string('latitude_konfigurasi', 200);
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
        Schema::dropIfExists('konfigurasi');
    }
}
