<?php

namespace Tests\Unit\Application\Transformer;

use Games\Games\Application\Transformer\Request\TransformerRequest;
use Games\Games\Application\Transformer\TransformerService;
use Games\Games\Domain\Transformer\Exception\TransformerNotFound;
use Games\Games\Domain\Transformer\Service\ServiceTransformer;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Infrastructure\Stub\Logger\MonologgerStub;
use Tests\Unit\Infrastructure\Stub\Transformer\TransformerArrayToXMLStub;
use Tests\Unit\Infrastructure\Stub\Transformer\TransformerXMLToStringStub;

final class TransformerTest extends TestCase
{
    private const RESPONSE = '';
    private const TYPE_XML = 'xmlToString';
    private const TYPE_ARRAY = 'arrayToXml';
    private const TYPE_ERROR = 'error';
    private const CONTENT = [];

    private TransformerService $transformer;
    private TransformerRequest $request;

    protected function setUp(): void
    {
        parent::setUp();

        $transformerService = new ServiceTransformer(
            new TransformerArrayToXMLStub(),
            new TransformerXMLToStringStub(),
            new MonologgerStub()
        );

        $this->transformer = new TransformerService(
            $transformerService
        );
    }

    /** @test */
    public function transformXMLToArray(): void
    {
        // Given
        $this->initializeValues(self::TYPE_XML);

        // When
        $response = $this->transformer->execute($this->request);

        // Then
        $this->assertEquals(self::CONTENT, $response);
    }

    /** @test */
    public function transformArrayToXML(): void
    {
        // Given
        $this->initializeValues(self::TYPE_ARRAY);

        // When
        $response = $this->transformer->execute($this->request);

        // Then
        $this->assertEquals(self::RESPONSE, $response);
    }

    /** @test */
    public function transformThrowTransformerNotFoundException(): void
    {
        // Given
        $this->initializeValues(self::TYPE_ERROR);

        // Then
        $this->expectException(TransformerNotFound::class);

        // When
        $this->transformer->execute($this->request);
    }

    private function initializeValues(string $type): void
    {
        $this->request = TransformerRequest::build(
            $type,
            self::CONTENT
        );
    }
}
