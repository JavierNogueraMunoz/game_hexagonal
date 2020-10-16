<?php

namespace Tests\Integration\Infrastructure\Transformer;

use Games\Games\Domain\Transformer\Entity\Content;
use Games\Games\Domain\Transformer\Entity\Transformer;
use Games\Games\Infrastructure\Transformer\TransformerXMLToStringService;
use Tests\IntegrationTest;

class TransformerXMLToStringTest extends IntegrationTest
{
    private const TYPE = 'xmlToArray';
    private const XML_ROUTE = 'example.xml';

    private array $message;
    private TransformerXMLToStringService $transformerXMLToString;
    private Transformer $transformer;

    private function initializeTransformation(): void
    {
        $this->transformerXMLToString = new TransformerXMLToStringService();

        $this->message = [
            'message' => [
                'key1' => 'value1',
                'key2' => [
                    'key3' => 'value3'
                ]
            ]
        ];

        $this->transformer = Transformer::build(
            self::TYPE,
            Content::build(
                file_get_contents(self::XML_ROUTE, true)
            )
        );
    }

    /** @test */
    public function transformationXmlToArray(): void
    {
        // Given
        $this->initializeTransformation();

        // When
        $response = $this->transformerXMLToString->get($this->transformer);

        // Then
        $this->assertEquals($this->message['message'], $response);
    }
}
