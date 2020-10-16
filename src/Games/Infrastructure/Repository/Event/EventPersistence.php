<?php

namespace Games\Games\Infrastructure\Repository\Event;

use Illuminate\Database\Eloquent\Model;

final class EventPersistence extends Model
{
    protected $table = 'event_store';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public $timestamps = false;
}
