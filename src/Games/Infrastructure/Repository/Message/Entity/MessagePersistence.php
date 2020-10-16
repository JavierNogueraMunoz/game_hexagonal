<?php

namespace Games\Games\Infrastructure\Repository\Message\Entity;

use Illuminate\Database\Eloquent\Model;

final class MessagePersistence extends Model
{
    protected $table = 'messages';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public $timestamps = false;
}
