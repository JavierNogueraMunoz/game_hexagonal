<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMessages extends Migration
{
    private const TABLE_MESSAGES = 'messages';

    public function up(): void
    {
        Schema::create(self::TABLE_MESSAGES, function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('user_id');
            $table->string('body_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(self::TABLE_MESSAGES);
    }
}
