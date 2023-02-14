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
            $table->string('logo')->nullable();
            $table->string('image')->nullable();
            $table->longText('description');
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->string('phone');
            // $table->string('tags');
            // $table->string('company');
            // $table->string('location');
            $table->string('email');
            // $table->string('website');
            $table->integer('avg_score');
            $table->char('payment_1');
            $table->char('payment_2');
            $table->char('payment_3');
            $table->integer('stock');
            $table->boolean('availability');
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
        Schema::dropIfExists('entrepreneurships');
    }
};
