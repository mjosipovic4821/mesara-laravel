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
        Schema::create('proizvods', function (Blueprint $table) {
            $table->id();
            $table->string('naziv_proizvoda', 120)->unique();
            $table->string('tip', 30)->nullable();
            $table->decimal('prodajna_cena', 12, 2)->default(0);
            $table->decimal('zaliha', 12, 3)->default(0);
            $table->boolean('aktivan')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proizvods');
    }
};
