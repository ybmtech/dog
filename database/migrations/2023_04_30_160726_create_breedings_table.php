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
        Schema::create('breedings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('first_dog_id')->constrained('dogs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('second_dog_id')->constrained('dogs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('fdog_user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('sdog_user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('reward',['payment','puppy'])->default('puppy');
            $table->string('amount')->nullable();
            $table->string('amount_paid')->nullable();
             $table->enum('status',['accept','reject','pending'])->default('pending');
             $table->enum('reward_status',['fulfilled','not fulfilled'])->default('not fulfilled');
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
        Schema::dropIfExists('breedings');
    }
};
