<?php

namespace Games\Games\Domain\Transformer;

use Games\Games\Domain\Transformer\Entity\Transformer;

interface TransformerXMLToString
{
    public function get(Transformer $transformer): array;
}
