<?php

namespace Games\Games\Domain\Transformer;

use Games\Games\Domain\Transformer\Entity\Transformer;

interface TransformerArrayToXML
{
    public function get(Transformer $transformer): string;
}
