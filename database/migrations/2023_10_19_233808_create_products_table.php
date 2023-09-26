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
        $table->foreignId('page_id')->constrained('pages')->cascadeOnDelete();
        $table->string('name');
        $table->string('description');
        $table->string('price');
        $table->Integer('amount');
        $table->Integer('count')->default(0);
        $table->string('image');
        $table->dateTime('start_date')->nullable();
        $table->dateTime('end_date')->nullable();
        $table->decimal('discount_percentage', 5, 2)->nullable()->default(0);

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
