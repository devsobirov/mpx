<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('developers')->nullable();
            $table->string('publishers')->nullable();
            $table->json('genres')->nullable();
            $table->json('description')->nullable();

            $table->string('image')->nullable();
            $table->string('image_og')->nullable();
            $table->string('keywords')->index()->nullable();

            $table->string('steam_app_id')->nullable();

            $table->float('discount')->nullable();
            $table->timestamp('released_at')->nullable();

            $table->boolean('status')->default(false);
            $table->integer('offers_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
