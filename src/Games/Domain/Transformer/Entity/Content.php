<?php

namespace Games\Games\Domain\Transformer\Entity;

class Content
{
    /** @var array | string */
    private $content;

    private function __construct(
        $content
    ) {
        $this->content = $content;
    }

    /**
     * @param array | string $content
     * @return static
     */
    public static function build(
        $content
    ): self {
        return new static($content);
    }

    /** @return array|string */
    public function getContent()
    {
        return $this->content;
    }
}
