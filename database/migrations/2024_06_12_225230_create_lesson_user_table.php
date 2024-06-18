<?php

use App\Models\User;
use App\Models\Cours\Lesson;
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
        Schema::create('lesson_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId(User::class)->constrained()->cascadeOnDelete();
            $table->foreignId(Lesson::class)->constrained()->cascadeOnDelete();
            $table->tinyInteger('apreciation')->nullable();
            $table->boolean('is_view')->default(True);
            $table->boolean('is_learned')->default(False);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_user');
    }
};
