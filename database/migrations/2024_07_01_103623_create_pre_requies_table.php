<?php

use App\Models\Matiere;
use App\Models\Cours\Niveau;
use App\Models\Cours\Partie\Lesson;
use App\Models\Cours\Partie\Chapitre;
use App\Models\Cours\Partie\PreRequie;
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
        Schema::create('pre_requies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('liens')->nullable();
            $table->foreignIdFor(Lesson::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_requies');
    }
};
