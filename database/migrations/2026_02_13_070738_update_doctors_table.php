<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            
            // Drop unwanted columns
            $table->dropColumn(['name', 'email', 'phone']);

            // Add foreign key
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Keep specialization nullable
            $table->string('specialization')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {

            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
        });
    }
};
