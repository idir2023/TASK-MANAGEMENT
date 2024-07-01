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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('assigned_to')->nullable(); // Can be a user ID if you have a users table
            $table->date('due_date')->nullable();
            $table->string('priority')->default('normal'); // E.g., 'low', 'normal', 'high'
            $table->string('status')->default('pending'); // E.g., 'pending', 'in-progress', 'completed'
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
