<?php

namespace Tests\Unit\Domain\Transformer\Service;

use Games\Games\Domain\Transformer\Entity\Transformer;
use Games\Games\Domain\Transformer\Exception\TransformerNotFound;
use Games\Games\Domain\Transformer\Service\ServiceTransformer;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Domain\Transformer\MotherObject\ContentMotherObject;
use Tests\Unit\Domain\Transformer\MotherObject\TransformerMotherObject;
use Tests\Unit\Infrastructure\Stub\Logger\MonologgerStub;
use Tests\Unit\Infrastructure\Stub\Transformer\TransformerArrayToXMLStub;
use Tests\Unit\Infrastructure\Stub\Transformer\TransformerXMLToStringStub;

class TransformerServiceTest extends TestCase
{
    private const RESPONSE_ARRAY = [];
    private const RESPONSE_STRING = '';

    private ServiceTransformer $transformerService;
    private Transformer $transformer;

    /** @test */
    public function transformerToArray(): void
    {
        // Given
        $this->transformer = TransformerMotherObject::buildFromArray();
        $this->initializeValues();

        // When
        $response = $this->transformerService->execute(
            $this->transformer
        );

        // Then
        $this->assertEquals(self::RESPONSE_STRING, $response);
    }

    /** @test */
    public function transformerToString(): void
    {
        // Given
        $this->transformer = TransformerMotherObject::buildFromString();
        $this->initializeValues();

        // When
        $response = $this->transformerService->execute(
            $this->transformer
        );

        // Then
        $this->assertEquals(self::RESPONSE_ARRAY, $response);
    }

    /** @test */
    public function transformerToArrayThrowTransformerNotFoundException(): void
    {
        // Given
        $this->transformer = Transformer::build(
            1234,
            ContentMotherObject::buildFromArray()
        );
        $this->initializeValues();

        // Then
        $this->expectException(TransformerNotFound::class);

        // When
        $this->transformerService->execute(
            $this->transformer
        );
    }

    private function initializeValues(): void
    {
        $this->transformerService = new ServiceTransformer(
            new TransformerArrayToXMLStub(),
            new TransformerXMLToStringStub(),
            new MonologgerStub()
        );
    }
}
