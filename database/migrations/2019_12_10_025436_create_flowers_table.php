<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flowers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('price');
            $table->mediumText('desc');
            $table->integer('stock');
            $table->string('cover_image');
            $table->timestamps();
            //To handle if related row in table flowerTypes get deleted
            $table->string('tname');

            //Foreign Key
            $table->unsignedBigInteger('flowerTypes_id');
            $table->foreign('flowerTypes_id')->references('id')->on('flowerTypes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flowers');
    }
}
