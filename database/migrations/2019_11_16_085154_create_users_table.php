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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('provider_id')->nullable();
            $table->string('first_name', 20);
            $table->string('last_name', 20);
            $table->string('contact_number', 20)->nullable();
            $table->string('gender')->nullable();
            $table->date('birthday')->nullable();
            $table->string('image')->nullable();
            $table->string('email', 30)->unique();
            $table->text('address')->nullable();
            $table->string('city', 20)->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('country', 20)->nullable();
            $table->string('username', 30)->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('otp', 10)->nullable();
            $table->enum('role', array('admin', 'auth_user', 'guest'))->default('guest');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
