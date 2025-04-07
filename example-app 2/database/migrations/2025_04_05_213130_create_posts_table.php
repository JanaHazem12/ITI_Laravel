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
            // adding the columns for the posts table
            $table->id();
            $table->string('title')->nullable();
            $table->text('description');
            // $table->string('postedBy')->nullable();
            $table->timestamps();
            // timestamps() --> for createdAt & updatedAt
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // when I rollback - this method is executed
        Schema::dropIfExists('posts');
    }
};
