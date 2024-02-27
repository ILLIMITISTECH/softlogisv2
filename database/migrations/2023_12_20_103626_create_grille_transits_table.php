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
        Schema::create('grille_transits', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->string('transitaire_uuid')->nullable();
            $table->string('had_uuid')->nullable();
            $table->integer('cout')->nullable();
            $table->string('etat')->default('actif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grille_transits');
    }
};
