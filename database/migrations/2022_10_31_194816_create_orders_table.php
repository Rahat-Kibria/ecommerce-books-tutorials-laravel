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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('coupon_id')->nullable()->constrained('coupons')->onDelete('cascade')->onUpdate('cascade');
            $table->ipAddress('ip_address')->nullable();
            $table->text('message')->nullable();
            $table->integer('coupon_discount')->nullable();
            $table->double('total');
            $table->double('grand_total');
            $table->enum('payment_type', array('cash on delivery', 'online payment'))->default('cash on delivery');
            $table->string('transaction_id', 100)->nullable();
            $table->string('currency', 100)->nullable();
            $table->enum('is_paid', array('pending', 'processing', 'complete', 'failed', 'canceled'))->default('pending');
            $table->enum('is_out_for_delivery', array('yes', 'no'))->default('no');
            $table->enum('is_completed', array('yes', 'no'))->default('no');
            $table->enum('is_seen_by_admin', array('yes', 'no'))->default('no');
            $table->enum('is_cancelled', array('yes', 'no'))->default('no');
            $table->timestamp('completion_date')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
