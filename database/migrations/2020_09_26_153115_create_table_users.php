<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUsers extends Migration
{
    private const TABLE_USERS = 'users';

    public function up(): void
    {
        Schema::create(self::TABLE_USERS, function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('address');
            $table->string('name');
            $table->string('surname');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(self::TABLE_USERS);
    }
}
