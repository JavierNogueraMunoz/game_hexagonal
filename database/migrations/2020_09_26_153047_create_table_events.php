<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEvents extends Migration
{
    private const TABLE_EVENTS = 'event_store';

    public function up(): void
    {
        Schema::create(self::TABLE_EVENTS, function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('entity');
            $table->timestamp('occurredOn');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(self::TABLE_EVENTS);
    }
}
