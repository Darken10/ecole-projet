<?php

use App\Models\Matiere;
use App\Models\Statut;
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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('pre_requis')->nullable();
            $table->text('plan');
            //$table->text('contenu')->nullable();
            $table->longText('content');
            $table->string('picture')->nullable();
            $table->foreignIdFor(Matiere::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->nullOnDelete();
            $table->foreignIdFor(Statut::class)->constrained();
            $table->dateTime('published_at')->default(now());
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
