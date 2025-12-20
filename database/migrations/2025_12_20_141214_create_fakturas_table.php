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
        Schema::disableForeignKeyConstraints();

        Schema::create('fakturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kupac_id')->constrained();
            $table->foreignId('radnik_id')->constrained();
            $table->date('datum');
            $table->text('napomena')->nullable();
            $table->decimal('ukupno', 12, 2)->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fakturas');
    }
};
