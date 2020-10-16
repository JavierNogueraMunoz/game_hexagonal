<?php

namespace Tests\Unit\Application\AnswerMessage\MotherObject;

use Games\Games\Application\AnswerMessage\Request\AnswerMessageRequest;

final class AnswerMessageRequestMotherObject
{
    private const UUID = '6062fea5-cc05-453b-8df2-e3fdaba5de6a';
    private const TYPE_COUNT = 'count_request';
    private const TYPE_REVERSE = 'reverse_request';
    private const USER = [
        'uuid' => 'e335ba19-2315-4753-9d78-7650ab644c4f',
        'name' => 'name',
        'surname' => 'surname',
        'address' => 'jnoguera@gmail.com'
    ];
    private const BODY = [
        'uuid' => '6062fea5-cc05-453b-8df2-e3fdaba5de6f',
        'address' => 'javi.noguera@icloud.com',
        'subject' => 'subject',
        'content' => 'hello'
    ];
    private const BODY_ERROR_ADDRESS = [
        'uuid' => '6062fea5-cc05-453b-8df2-e3fdaba5de6f',
        'address' => 'javi.nogueraicloud.com',
        'subject' => 'subject',
        'content' => 'hello'
    ];

    public static function buildCountMessage(
        string $uuid = null,
        array $user = null,
        array $body = null,
        string $type = null
    ): AnswerMessageRequest {
        return AnswerMessageRequest::create(
            $uuid ?? self::UUID,
            $user ?? self::USER,
            $body ?? self::BODY,
            $type ?? self::TYPE_COUNT
        );
    }

    public static function buildCountMessageErrorAddress(
        string $uuid = null,
        array $user = null,
        array $body = null,
        string $type = null
    ): AnswerMessageRequest {
        return AnswerMessageRequest::create(
            $uuid ?? self::UUID,
            $user ?? self::USER,
            $body ?? self::BODY_ERROR_ADDRESS,
            $type ?? self::TYPE_COUNT
        );
    }

    public static function buildReverseMessage(
        string $uuid = null,
        array $user = null,
        array $body = null,
        string $type = null
    ): AnswerMessageRequest {
        return AnswerMessageRequest::create(
            $uuid ?? self::UUID,
            $user ?? self::USER,
            $body ?? self::BODY,
            $type ?? self::TYPE_REVERSE
        );
    }
}
