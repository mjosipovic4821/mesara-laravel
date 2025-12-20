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
        Schema::create('kupacs', function (Blueprint $table) {
            $table->id();
            $table->string('naziv_kupca', 120);
            $table->string('telefon', 30)->nullable();
            $table->string('email', 120)->nullable();
            $table->string('adresa', 160)->nullable();
            $table->string('grad', 80)->nullable();
            $table->string('pib', 20)->nullable()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kupacs');
    }
};
