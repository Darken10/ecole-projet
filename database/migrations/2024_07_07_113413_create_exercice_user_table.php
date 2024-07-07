<?php

use App\Models\User;
use App\Models\Cours\Exercice;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exercice_user', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('note_max');
            $table->tinyInteger('note')->default(0);
            $table->json('response');
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Exercice::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercice_user');
    }
};
