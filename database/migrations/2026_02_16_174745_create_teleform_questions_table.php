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
        Schema::create('teleform_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('step_id')->constrained('teleform_steps')->onDelete('cascade');
            $table->string('question');
            $table->string('type'); // text, number, textarea, select, file
            $table->string('field_key'); // unique key like weight, height
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teleform_questions');
    }
};
