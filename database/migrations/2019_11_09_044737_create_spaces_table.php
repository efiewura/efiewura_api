<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spaces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('description');
            $table->string('price');
            $table->string('neg_flag');
            $table->string('grant');
            $table->unsignedBigInteger('efiewura_id')->unsigned()->index()->nullable();
            $table->foreign('efiewura_id')->references('id')->on('efiewuras');
            $table->unsignedBigInteger('location_id')->unsigned()->index()->nullable();
            $table->foreign('location_id')->references('id')->on('locations');
            $table->softDeletes();
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
        Schema::dropIfExists('spaces');
    }
}
