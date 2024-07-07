<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use App\Models\Cours\Partie\UserQuestion;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_question_responses', function (Blueprint $table) {
            $table->id();
            $table->text('response');
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(UserQuestion::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_question_responses');
    }
};
