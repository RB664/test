<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->text('image')->default('https://i.postimg.cc/PrFQYgZZ/Default-PFP.png'); // Set default value
            $table->string('fullname');
            $table->string('email')->unique();
            $table->integer('phone_number');
            $table->date('date_of_birth');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('user_role')->default('Member');
            $table->string('username');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
