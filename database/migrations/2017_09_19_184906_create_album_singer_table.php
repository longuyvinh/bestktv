<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumSingerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_singer', function (Blueprint $table) {
            $table->integer('album_id')->unsigned()->index();
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
            $table->integer('singer_id')->unsigned()->index();
            $table->foreign('singer_id')->references('id')->on('singers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('album_singer');
    }
}
