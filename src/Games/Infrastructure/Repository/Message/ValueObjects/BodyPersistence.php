<?php

namespace Games\Games\Infrastructure\Repository\Message\ValueObjects;

use Illuminate\Database\Eloquent\Model;

final class BodyPersistence extends Model
{
    protected $table = 'body';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public $timestamps = false;
}
