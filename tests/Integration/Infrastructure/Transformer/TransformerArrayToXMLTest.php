<?php

namespace Tests\Integration\Infrastructure\Transformer;

use Games\Games\Domain\Transformer\Entity\Content;
use Games\Games\Domain\Transformer\Entity\Transformer;
use Games\Games\Infrastructure\Transformer\TransformerArrayToXMLService;
use Tests\IntegrationTest;

class TransformerArrayToXMLTest extends IntegrationTest
{
    private const XML_ROUTE = 'example.xml';
    private const TYPE = 'arrayToXML';
    private array $message;
    private string $xml;
    private Transformer $transformer;
    private TransformerArrayToXMLService $transformerArrayToXML;

    private function initializeTransformation(): void
    {
        $this->transformerArrayToXML = new TransformerArrayToXMLService();
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
            Content::build($this->message)
        );

        $this->xml = file_get_contents(self::XML_ROUTE, true);
    }

    /** @test */
    public function transformationArrayToXml(): void
    {
        // Given
        $this->initializeTransformation();

        // When
        $response = $this->transformerArrayToXML->get($this->transformer);

        // Then
        $this->assertEquals($this->xml, $response);
    }
}
