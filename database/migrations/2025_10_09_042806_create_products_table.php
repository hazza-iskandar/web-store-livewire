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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories');
            $table->string('title');
            $table->string('slug')->unique();
            $table->integer('price');
            $table->integer('stock')->nullable()->default(0);
            $table->enum('status', ['draft', 'publish'])->deffault('draft');
            $table->text('desc');
            $table->string('thumbnail')->nullable();
            $table->json('images')->nullable();
            $table->integer('total_sold')->nullable();
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
