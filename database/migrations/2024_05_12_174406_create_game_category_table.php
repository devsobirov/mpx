<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('game_category', function (Blueprint $table) {
            $table->id();

            $table->string('category_slug')->index();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('game_id');
            $table->integer('offers_count')->default(0);

            $table->foreign('category_slug')
                ->references('slug')
                ->on('categories')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('game_id')
                ->references('id')
                ->on('games')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->unique(['game_id', 'category_slug']);
        });

        Schema::table('game_category', function (Blueprint $table) {
            $table->foreign('parent_id')
                ->references('id')
                ->on('game_category')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('game_category');
    }
};
