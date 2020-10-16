<?php

namespace Tests\Unit\Domain\Transformer;

use Games\Games\Domain\Transformer\Entity\Content;
use PHPUnit\Framework\TestCase;

class ContentTest extends TestCase
{
    private const CONTENT_ARRAY = [];
    private const CONTENT_STRING = '';

    private array $contentArray;
    private string $contentString;

    /** @test */
    public function buildContentWithString(): void
    {
        // Given
        $this->initializeValues();

        // When
        $content = Content::build($this->contentString);

        // Then
        $this->assertSame(self::CONTENT_STRING, $content->getContent());
    }

    /** @test */
    public function buildContentWithArray(): void
    {
        // Given
        $this->initializeValues();

        // When
        $content = Content::build($this->contentArray);

        // Then
        $this->assertSame(self::CONTENT_ARRAY, $content->getContent());
    }

    private function initializeValues(): void
    {
        $this->contentArray = self::CONTENT_ARRAY;
        $this->contentString = self::CONTENT_STRING;
    }
}
