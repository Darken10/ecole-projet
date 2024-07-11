<?php

use App\Models\Matiere;
use App\Models\Cours\Niveau;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Migrations\Migrationgration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('matiere_niveau', function (Blueprint $table) {
            $table->foreignIdFor(Matiere::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Niveau::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matiere_niveau');
    }
};
