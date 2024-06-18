<?php

use App\Models\Cours\Evaluation;
use App\Models\Cours\Niveau;
use App\Models\Cours\TypeQuestion;
use App\Models\User;
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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->tinyInteger('point')->default(1);
            $table->foreignIdFor(TypeQuestion::class)->default(1)->constrained()->restrictOnDelete();
            $table->foreignIdFor(Evaluation::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
