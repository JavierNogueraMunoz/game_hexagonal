<?php

namespace Games\Games\Infrastructure\Repository\User;

use Illuminate\Database\Eloquent\Model;

class UserPersistence extends Model
{
    protected $table = 'users';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public $timestamps = false;
}
