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
        Schema::table('custom_messages', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('text');
            $table->longText('message_sms')->nullable();
            $table->longText('message_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_messages', function (Blueprint $table) {
            $table->string('type');
        });
    }
};
