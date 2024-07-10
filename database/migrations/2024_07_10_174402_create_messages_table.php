<?php

use App\Models\User;
use App\Models\Chat\Conversation;
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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->integer('from_id',unsigned:true);
            $table->foreign('from_id','from')->references('id')->on('users')->cascadeOnDelete();
            $table->integer('to_id',unsigned:true);
            $table->foreign('to_id','to')->references('id')->on('users')->cascadeOnDelete();
            $table->text('message');
            $table->dateTime('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
