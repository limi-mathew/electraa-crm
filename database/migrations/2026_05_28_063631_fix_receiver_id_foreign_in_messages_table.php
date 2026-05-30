<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {

            // Drop existing foreign key first
            $table->dropForeign(['receiver_id']);

            // Recreate correctly
            $table->foreign('receiver_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {

            $table->dropForeign(['receiver_id']);

            $table->foreign('receiver_id')
                ->references('id')
                ->on('users');
        });
    }
};
