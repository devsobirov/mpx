<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('developers')->nullable();
            $table->string('publishers')->nullable();
            $table->json('genres')->nullable();

            $table->string('image')->nullable();
            $table->string('image_feed')->nullable();
            $table->string('image_og')->nullable();

            $table->json('meta_title')->nullable();
            $table->json('meta_description')->nullable();
            $table->string('keywords')->index()->nullable();

            $table->string('steam_app_id')->nullable();

            $table->float('discount')->nullable();
            $table->timestamp('released_at')->nullable();

            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
