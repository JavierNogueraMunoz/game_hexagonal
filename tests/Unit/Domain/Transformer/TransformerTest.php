<?php

namespace Tests\Unit\Domain\Transformer;

use Games\Games\Domain\Transformer\Entity\Content;
use Games\Games\Domain\Transformer\Entity\Transformer;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Domain\Transformer\MotherObject\ContentMotherObject;

class TransformerTest extends TestCase
{
    private const TYPE_ARRAY = '';

    private string $type;
    private Content $content;

    /** @test */
    public function buildTransformer(): void
    {
        // Given
        $this->initializeValues();

        // When
        $transformer = Transformer::build(
          $this->type,
          $this->content
        );

        // Then
        $this->assertSame(self::TYPE_ARRAY, $transformer->getType());
        $this->assertSame($this->content->getContent(), $transformer->getContentEntity());
    }

    private function initializeValues(): void
    {
        $this->type = self::TYPE_ARRAY;
        $this->content = ContentMotherObject::buildFromArray();
    }
}
