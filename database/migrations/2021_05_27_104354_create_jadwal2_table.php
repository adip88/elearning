<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwal2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal2', function (Blueprint $table) {
            $table->id();
            $table->string('hari',10);
            $table->unsignedBigInteger('guru_studi_id');
            $table->unsignedBigInteger('studi_id');
            $table->unsignedBigInteger('jam_id');
            $table->timestamps();

            $table->foreign('studi_id')->references('id')->on('studi')->onDelete('cascade');
            $table->foreign('guru_studi_id')->references('id')->on('guru_studi')->onDelete('cascade');
            $table->foreign('jam_id')->references('id')->on('jam')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal2');
    }
}
