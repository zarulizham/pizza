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
        Schema::create('pizza_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pizza_id')->nullable()
                ->constrained(
                    table: 'pizzas'
                )->onUpdate('set null')->onDelete('set null');
            $table->string('name', 100)->nullable()->default('text');
            $table->double('price', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pizza_sizes');
    }
};
