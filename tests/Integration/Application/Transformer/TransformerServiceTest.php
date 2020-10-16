<?php

namespace Tests\Integration\Application\Transformer;

use Games\Games\Application\Transformer\Request\TransformerRequest;
use Games\Games\Application\Transformer\TransformerService;
use Games\Games\Domain\Transformer\Exception\TransformerNotFound;
use Games\Games\Domain\Transformer\Service\ServiceTransformer;
use Games\Games\Infrastructure\Logger\MonologLogger;
use Games\Games\Infrastructure\Transformer\TransformerArrayToXMLService;
use Games\Games\Infrastructure\Transformer\TransformerXMLToStringService;
use Tests\IntegrationTest;

class TransformerServiceTest extends IntegrationTest
{
    private const TYPE_XML = 'xmlToString';
    private const CONTENT_XML = '<?xml version="1.0" encoding="UTF-8"?>
<count_request>
  <uuid>6062fea5-cc05-453b-8df2-e3fdaba5de6a</uuid>
  <type>count_request</type>
  <user>
    <uuid>e335ba19-7845-4753-9d78-7650ab644c4f</uuid>
    <name>Nombre del usuario</name>
    <surname>Nombre del usuario</surname>
    <address>javi.noguera@icloud.com</address>
  </user>
  <body>
    <uuid>e335ba19-7845-4753-9d78-9000ab644c4f</uuid>
    <address>jnogueramunoz@gmail.com</address>
    <subject>Este es el titulo del mensaje</subject>
    <content>Hellos</content>
  </body>
</count_request>
';
    private const TYPE_ARRAY = 'arrayToXml';
    private const TYPE_ERROR = 'error';
    private const CONTENT = [
        "uuid" => "6062fea5-cc05-453b-8df2-e3fdaba5de6a",
        "type" => "count_request",
        "user" => [
            "uuid" => "e335ba19-7845-4753-9d78-7650ab644c4f",
            "name" => "Nombre del usuario",
            "surname" => "Nombre del usuario",
            "address" => "javi.noguera@icloud.com"
        ],
        "body" => [
            "uuid" => "e335ba19-7845-4753-9d78-9000ab644c4f",
            "address" => "jnogueramunoz@gmail.com",
            "subject" => "Este es el titulo del mensaje",
            "content" => "Hellos"
        ]
    ];
    private const CONTENT_ARRAY = [
        'count_request' => self::CONTENT
    ];

    private TransformerService $transformerService;
    private TransformerRequest $request;

    protected function setUp(): void
    {
        parent::setUp();

        $serviceTransformer = new ServiceTransformer(
            new TransformerArrayToXMLService(),
            new TransformerXMLToStringService(),
            new MonologLogger()
        );

        $this->transformerService = new TransformerService(
            $serviceTransformer
        );
    }

    /** @test */
    public function transformXmlToArray(): void
    {
        // Given
        $this->initializeValues(self::TYPE_XML, self::CONTENT_XML);

        // When
        $response = $this->transformerService->execute($this->request);

        // Then
        $this->assertEquals(self::CONTENT, $response);
    }

    /** @test */
    public function transformArrayToXml(): void
    {
        // Given
        $this->initializeValues(self::TYPE_ARRAY, self::CONTENT_ARRAY);

        // When
        $response = $this->transformerService->execute($this->request);

        // Then
        $this->assertEquals(self::CONTENT_XML, $response);
    }

    /** @test */
    public function transformTransformerNotFound(): void
    {
        // Given
        $this->initializeValues(self::TYPE_ERROR, self::CONTENT_XML);

        // Then
        $this->expectException(TransformerNotFound::class);

        // When
        $this->transformerService->execute($this->request);
    }

    private function initializeValues(string $type, $content): void
    {
        $this->request = TransformerRequest::build(
            $type,
            $content
        );
    }
}
