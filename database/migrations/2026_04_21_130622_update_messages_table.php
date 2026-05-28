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
        Schema::table('messages', function (Blueprint $table) {

            $table->dropForeign(['receiver_id']);

            $table->foreign('receiver_id')
                ->references('id')
                ->on('customers')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {

            // rollback: remove customer FK
            $table->dropForeign(['receiver_id']);

            // restore users FK
            $table->foreign('receiver_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }
};
