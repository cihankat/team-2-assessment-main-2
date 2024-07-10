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
        Schema::create('userstories_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId("checklist_id")->constrained('checklists');
            $table->foreignId("userstory_id")->constrained('userstories');
            $table->foreignId("user_id")->constrained('users');
            $table->boolean('check');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userstories_users');
    }
};