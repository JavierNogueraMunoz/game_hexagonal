<?php

namespace Tests\Unit\Application\Transformer\Request;

use Games\Games\Application\Transformer\Request\TransformerRequest;
use PHPUnit\Framework\TestCase;

class TransformerRequestTest extends TestCase
{
    private const TYPE = '';
    private const CONTENT = [];

    private string $type;
    private $content;

    /** @test */
    public function buildTransformerRequest(): void
    {
        // Given
        $this->initializeValues();

        // When
        $request = TransformerRequest::build(
            $this->type,
            $this->content
        );

        // Then
        $this->assertSame(self::TYPE, $request->getType());
        $this->assertSame(self::CONTENT, $request->getContent());
    }

    private function initializeValues(): void
    {
        $this->type = self::TYPE;
        $this->content = self::CONTENT;
    }
}
