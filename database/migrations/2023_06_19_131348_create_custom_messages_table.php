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
        Schema::create('custom_messages', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->max(25);
            $table->string('type')->max(5);
            $table->string('language')->max(5);
            $table->longText('text');
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_messages');
    }
};
