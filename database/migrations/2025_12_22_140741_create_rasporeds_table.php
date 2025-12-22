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
        Schema::create('rasporeds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('radnik_id')->constrained();
            $table->date('week_start');
            $table->unsignedTinyInteger('dan'); // 0-6
            $table->string('smena', 20); // jutro/vece/slobodan
            $table->string('zadatak', 255)->nullable();
            $table->timestamps();

            $table->unique(['radnik_id', 'week_start', 'dan'], 'raspored_unique_radnik_week_dan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rasporeds');
    }
};
