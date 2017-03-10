<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaceTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_tag', function(Blueprint $table) {
          $table->increments('id');
          $table->integer('place_id')->unsigned();
          $table->foreign('place_id')->references('id')->on('places');
          $table->integer('tag_id')->unsigned();
          $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('place_tag');
    }
}
