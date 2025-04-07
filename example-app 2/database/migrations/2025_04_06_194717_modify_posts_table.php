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
        Schema::table(
            "posts",
            function (Blueprint $table) {
                if (!Schema::hasColumn('posts', 'user_id')) {
                // creating 'user_id' col. with datatype unsignedBigInteger
                $table->unsignedBigInteger('user_id')->nullable();
                // this 'user_id' references the id in users
                $table->foreign('user_id')->references('id')->on('users'); 
                // ->cascadeOnDelete() use it in COMMENTS           
                }
            }
        );
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // drop the constraint + column added in the up method^^ in case of ROLLBACK
    }
};
