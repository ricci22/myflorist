<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('qty');
            $table->integer('total');
            $table->timestamps();

            // this is to store the flower image if the related image in table flower get deleted
            $table->string('fimage');
            // this is to store the flower name if the related name n table flower get deleted
            $table->string('fname');

            // Foreign Key and Constraint
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('flower_id');
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->foreign('flower_id')->references('id')->on('flowers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_details');
    }
}
