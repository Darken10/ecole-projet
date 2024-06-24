<?php

use App\Models\User;
use App\Models\Cours\Corriger;
use App\Models\Cours\Question;
use App\Models\Cours\Response;
use App\Models\Cours\Soumission;
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
        Schema::create('corrigers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Question::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Soumission::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Response::class)->nullable();
            $table->text('response_text')->nullable();
            $table->timestamps();
        });

        Schema::create('corriger_response', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Corriger::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Response::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corriger_response');
        Schema::dropIfExists('corrigers');
    }
};
