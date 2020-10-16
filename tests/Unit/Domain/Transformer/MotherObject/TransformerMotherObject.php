<?php

namespace Tests\Unit\Domain\Transformer\MotherObject;

use Games\Games\Domain\Transformer\Entity\Content;
use Games\Games\Domain\Transformer\Entity\Transformer;

class TransformerMotherObject
{
    private const TYPE_ARRAY = 'arrayToXml';
    private const TYPE_STRING = 'xmlToString';

    public static function buildFromArray(
        string $type = null,
        Content $content = null
    ): Transformer {
        return Transformer::build(
            $type ?? self::TYPE_ARRAY,
            $content ?? ContentMotherObject::buildFromArray()
        );
    }

    public static function buildFromString(
        string $type = null,
        Content $content = null
    ): Transformer {
        return Transformer::build(
            $type ?? self::TYPE_STRING,
            $content ?? ContentMotherObject::buildFromString()
        );
    }
}
