<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('transactions', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->integer('total');
        $table->timestamps();

        // this to store the courier name, if the related name in table courier get deleted
        $table->string('cname');
        // this is to store the user name if the related name in table user get deleted
        $table->string('uname');

        // Foreign Key and constraint
        $table->unsignedBigInteger('courier_id');
        $table->unsignedBigInteger("user_id");
        $table->foreign('courier_id')->references('id')->on('couriers');
        $table->foreign('user_id')->references('id')->on('users');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
