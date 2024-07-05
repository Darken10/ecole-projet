<?php

use App\Models\Cours\Niveau;
use App\Models\Cours\Partie\Chapitre;
use App\Models\Cours\Partie\Lesson;
use App\Models\Cours\PieceJoint;
use App\Models\Matiere;
use App\Models\User;
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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('numero_section',unsigned:True)->default(1);
            $table->string('section_title')->nullable();
            $table->longText('content');
            $table->foreignIdFor(Lesson::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->restrictOnDelete();
            $table->timestamps();
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
