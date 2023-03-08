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
        Schema::create('entrepreneurships', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title');
            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('product_img')->nullable();
            $table->longText('description');
            $table->float('price');
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->integer('avg_score')->nullable();
            $table->boolean('cash_payment');
            $table->boolean('card_payment');
            $table->boolean('bizum_payment');
            $table->integer('stock')->nullable();
            $table->foreignId('availability_state')->references('id')->on('availability_states');
            $table->string('phone_number');
            $table->string('email');
            $table->string('location');
            $table->foreignId('inspection_state')->references('id')->on('inspection_states');
            // $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entrepreneurships');
    }
};
