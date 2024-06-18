<?php

use App\Models\Statut;
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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_exam')->default(False);
            $table->tinyInteger('level',unsigned:True)->default(1)->min(0)->max(10);
            $table->foreignIdFor(Statut::class)->default(1)->constrained()->nullOnDelete();
            $table->string('serie',5)->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
