<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->float('wa');
            $table->timestamps();
        });
        //Create 'phone_user' table 
        Schema::create('space_tag', function(Blueprint $table) {
          $table->increments('id');
          $table->unsignedBigInteger('space_id')->unsigned()->index();
          $table->foreign('space_id')->references('id')->on('spaces')->onDelete('cascade');
          $table->unsignedBigInteger('tag_id')->unsigned()->index();
          $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('space_tag');
        Schema::dropIfExists('tags');
    }
}
