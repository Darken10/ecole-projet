<?php

use App\Models\User;
use App\Models\Statut;
use App\Models\Matiere;
use App\Models\Cours\Partie\Content;
use App\Models\Cours\Partie\Chapitre;
use App\Models\Cours\Partie\Objectif;
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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->tinyInteger('lesson_numero',unsigned:True)->default(1);
            $table->string('image_uri')->nullable();
            $table->foreignIdFor(User::class)->constrained()->nullOnDelete();
            $table->foreignIdFor(Chapitre::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Statut::class)->constrained()->nullOnDelete();
            $table->dateTime('published_at')->default(now());
            $table->integer('nb_views')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
