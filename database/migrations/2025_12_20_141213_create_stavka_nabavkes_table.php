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

        Schema::create('stavka_nabavkes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nabavka_id')->constrained();
            $table->foreignId('materijal_id')->constrained();
            $table->decimal('kolicina', 12, 3);
            $table->decimal('cena_po_jedinici', 12, 2);
            $table->decimal('iznos', 12, 2);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stavka_nabavkes');
    }
};
