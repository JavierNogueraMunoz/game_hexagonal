<?php

namespace Tests\Unit\Infrastructure\Stub\Transformer;

use Games\Games\Domain\Transformer\Entity\Transformer;
use Games\Games\Domain\Transformer\TransformerXMLToString;

class TransformerXMLToStringStub implements TransformerXMLToString
{
    public function get(Transformer $transformer): array
    {
        return [];
    }
}
