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
        Schema::create('entrepreneurship', function(Blueprint $table){
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('image');
            $table->string('logo')->nullable();
            // $table->string('tags');
            // $table->string('company');
            // $table->string('location');
            $table->string('email');
            $table->string('website');
            $table->longText('description');
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
        Schema::dropIfExists('entrepreneurship');
        Schema::disableForeignKeyConstraints();
    }
};
