<?php

namespace Games\Games\Infrastructure\Validator;

use DOMDocument;
use Games\Games\Domain\Validator\Validator;
use Games\Games\Domain\Validator\XMLNotValid;

class ValidatorService implements Validator
{
    private array $feedSchema;
    private DOMDocument $handler;

    public function __construct()
    {
        $this->feedSchema = [
            'count_request'   => __DIR__ . '/XSD/Request/Count.xsd',
            'reverse_request' => __DIR__ . '/XSD/Request/Reverse.xsd'
        ];

        $this->handler = new DOMDocument('1.0', 'UTF-8');
        libxml_use_internal_errors(true);
    }

    public function xml(string $xml, string $type): bool
    {
        $this->handler->loadXML($xml);
        return $this->handler->schemaValidate($this->feedSchema[$type]);
    }
}
