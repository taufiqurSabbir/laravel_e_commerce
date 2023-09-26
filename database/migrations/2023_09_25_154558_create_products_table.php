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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->String('product_code');
            $table->String('name');
            $table->String('description');
            $table->json('color');
            $table->json('size');
            $table->String('price');
            $table->boolean('isPopular');
            $table->boolean('isNew');
            $table->boolean('isSpecial');
            $table->String('Stock');
            $table->foreignId('category_id')->constrained('categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
