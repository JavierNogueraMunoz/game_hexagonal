<?php

namespace Games\Games\Application\Transformer\Request;

class TransformerRequest
{
    private string $type;
    private $content;

    private function __construct(
        string $type,
        $content
    ) {
        $this->type = $type;
        $this->content = $content;
    }

    public static function build(
        string $type,
        $content
    ): self {
        return new static($type, $content);
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getContent()
    {
        return $this->content;
    }
}
