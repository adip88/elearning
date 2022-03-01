<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuruStudiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guru_studi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('studi_id');
            $table->unsignedBigInteger('users_id');
            $table->timestamps();

            $table->foreign('studi_id')->references('id')->on('studi')->onDelete('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guru_studi');
    }
}
