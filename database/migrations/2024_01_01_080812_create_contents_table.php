<?php

use App\Models\User;
use App\Models\Matiere;
use App\Models\Cours\Niveau;
use App\Models\Cours\PieceJoint;
use App\Models\Cours\Partie\Lesson;
use App\Models\Cours\Partie\Content;
use App\Models\Cours\Partie\Chapitre;
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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('numero_section',unsigned:True)->default(1);
            $table->string('section_title')->nullable();
            $table->longText('content');
            $table->unsignedBigInteger('next_section')->nullable();
            $table->unsignedBigInteger('prev_section')->nullable();
            $table->foreignIdFor(Lesson::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->restrictOnDelete();
            $table->timestamps();

            $table->foreign('next_section')->on('contents')->references('id')->constrained();
            $table->foreign('prev_section')->on('contents')->references('id')->constrained();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
