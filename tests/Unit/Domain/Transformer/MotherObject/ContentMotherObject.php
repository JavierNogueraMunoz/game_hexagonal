<?php

namespace Tests\Unit\Domain\Transformer\MotherObject;

use Games\Games\Domain\Transformer\Entity\Content;

class ContentMotherObject
{
    private const CONTENT_ARRAY = [];
    private const CONTENT_STRING = '';

    public static function buildFromArray(
        array $content = null
    ): Content {
        return Content::build(
            $content ?? self::CONTENT_ARRAY
        );
    }

    public static function buildFromString(
        string $content = null
    ): Content {
        return Content::build(
            $content ?? self::CONTENT_STRING
        );
    }
}
