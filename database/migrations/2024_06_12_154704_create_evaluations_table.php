<?php

use App\Models\User;
use App\Models\Statut;
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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('cote')->default(1);
            $table->tinyInteger('note_max')->default(20);
            $table->text('description')->nullable();
            $table->time('time');
            $table->tinyInteger('difficulty')->default(1);
            $table->integer('prof',unsigned:true)->unsigned();
            $table->foreign('prof','prof')->references('id')->on('users')->cascadeOnDelete();
            //$table->foreignIdFor(User::class,'prof')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Lesson::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Statut::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
