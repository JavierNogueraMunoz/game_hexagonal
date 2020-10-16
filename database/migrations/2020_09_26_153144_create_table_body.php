<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBody extends Migration
{
    private const TABLE_BODY = 'body';

    public function up(): void
    {
        Schema::create(self::TABLE_BODY, function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('address');
            $table->string('subject');
            $table->string('content');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(self::TABLE_BODY);
    }
}
