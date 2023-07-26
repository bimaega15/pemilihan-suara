<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRangeBobotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('range_bobot', function (Blueprint $table) {
            $table->increments('id');
            $table->double('dari_range_bobot', 8, 2);
            $table->double('sampai_range_bobot', 8, 2);
            $table->string('nama_range_bobot', 200);
            $table->text('solusi_range_bobot')->nullable();
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
        Schema::dropIfExists('range_bobot');
    }
}
