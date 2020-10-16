<?php

namespace Tests\Unit\Infrastructure\Stub\Transformer;

use Games\Games\Domain\Transformer\Entity\Transformer;
use Games\Games\Domain\Transformer\TransformerArrayToXML;

class TransformerArrayToXMLStub implements TransformerArrayToXML
{
    public function get(Transformer $transformer): string
    {
        return '';
    }
}
