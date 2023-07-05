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
        Schema::table('user_email_histories', function (Blueprint $table) {
            $table->dropForeign(['custom_message_id']);
            $table->dropColumn('custom_message_id');
            $table->longText('text');
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_email_histories', function (Blueprint $table) {
            //
        });
    }
};
