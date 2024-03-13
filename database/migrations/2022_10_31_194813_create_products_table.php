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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories');
            $table->string('name', 50);
            $table->string('author');
            $table->string('slug', 50);
            $table->text('short_description');
            $table->text('description');
            $table->enum('type', array('Book', 'Tutorial'));
            $table->double('purchase_price');
            $table->double('price', 7, 2);
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->double('discount');
            $table->integer('quantity');
            $table->enum('stock_status', array('Available', 'Not Available'))->default('Available');
            $table->enum('featured', array('Yes', 'No'))->default('No');
            $table->bigInteger('viewed')->default(0);
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
        Schema::dropIfExists('products');
    }
};
