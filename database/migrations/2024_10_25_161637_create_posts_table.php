<?php

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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('content');
            $table->string('thumbnail')->nullable(); //maybe for thumbnail
            $table->string('tags');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->boolean('is_visible')->default(true);
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
