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
        Schema::create('materijals', function (Blueprint $table) {
            $table->id();
            $table->string('naziv', 120)->unique();
            $table->string('jedinica_mere', 12);
            $table->decimal('zaliha', 12, 3)->default(0);
            $table->decimal('referentna_cena', 12, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materijals');
    }
};
