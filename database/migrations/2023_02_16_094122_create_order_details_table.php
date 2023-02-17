<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table-> unsignedBigInteger('order_id');
            $table-> foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table-> unsignedBigInteger('entrepreneurship_id');
            $table-> foreign('entrepreneurship_id')->references('id')->on('entrepreneurships')->onDelete('cascade');
            $table-> float('quantity');
            $table->boolean('paid');
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
        Schema::dropIfExists('order_details');
    }
};
