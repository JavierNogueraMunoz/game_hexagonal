<?php

namespace Games\Games\Infrastructure\Transformer;

use Games\Games\Domain\Transformer\Entity\Transformer;
use Games\Games\Domain\Transformer\TransformerXMLToString;

class TransformerXMLToStringService implements TransformerXMLToString
{
    public function get(Transformer $transformer): array
    {
        return $this->transformStringToArray(simplexml_load_string($transformer->getContentEntity()));
    }

    private function transformStringToArray($element): array
    {
        return json_decode(json_encode($element), true);
    }
}
