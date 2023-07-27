<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about', function (Blueprint $table) {
            $table->increments('id');
            $table->text('keterangan_about');
            $table->text('gambar_about')->nullable();
            $table->string('project_about')->nullable();
            $table->string('customers_about')->nullable();
            $table->string('team_about')->nullable();
            $table->string('awards_about')->nullable();
            $table->text('teamdetail_about')->nullable();
            $table->text('gambarsponsor_about')->nullable();
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
        Schema::dropIfExists('about');
    }
}
