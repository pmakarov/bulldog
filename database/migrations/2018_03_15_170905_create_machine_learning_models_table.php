<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMachineLearningModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machine_learning_models', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('object');
            $table->integer('algorithm_id')->unsigned();
            $table->timestamps();

            $table->foreign('algorithm_id')->references('id')->on('algorithms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('machine_learning_models');
    }
}
