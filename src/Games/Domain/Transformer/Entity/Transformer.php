<?php

namespace Games\Games\Domain\Transformer\Entity;

class Transformer
{
    private Content $content;
    private string $type;

    private function __construct(
        string $type,
        Content $content
    ) {
        $this->type = $type;
        $this->content = $content;
    }

    public static function build(
        string $type,
        Content $content
    ): self
    {
        return new static($type, $content);
    }

    public function getType(): string
    {
        return $this->type;
    }

    /** @return array|string */
    public function getContentEntity()
    {
        return $this->content->getContent();
    }
}
