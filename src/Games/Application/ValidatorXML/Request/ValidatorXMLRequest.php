<?php

namespace Games\Games\Application\ValidatorXML\Request;

class ValidatorXMLRequest
{
    private string $content, $type;

    private function __construct(
        string $type,
        string $content
    ) {
        $this->type = $type;
        $this->content = $content;
    }

    public static function build(
        string $type,
        string $content
    ): self {
        return new static($type, $content);
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
