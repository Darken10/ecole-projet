<?php

use App\Models\Cours\Lesson;
use App\Models\Cours\PieceJoint;
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
        Schema::create('lesson_piece_joint', function (Blueprint $table) {
            $table->id();
            $table->foreignId(PieceJoint::class)->constrained()->cascadeOnDelete();
            $table->foreignId(Lesson::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_piece_joint');
    }
};
