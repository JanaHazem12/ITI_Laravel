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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('comment_body');
            $table->unsignedBigInteger('comment_user_id')->nullable();
            // cascadeOnDelete() -> when deleting post/user, ALL of its comments should be deleted
            $table->foreign('comment_user_id')->references('id')->on('users')->cascadeOnDelete(); 
            $table->unsignedBigInteger('post_id')->nullable();
            $table->foreign('post_id')->references('id')->on('posts')->cascadeOnDelete(); 
            $table->timestamps();
            // forceDelete the comment
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
