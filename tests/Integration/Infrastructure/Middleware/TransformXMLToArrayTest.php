<?php

namespace Tests\Integration\Infrastructure\Middleware;

use Games\Games\Application\Transformer\TransformerService;
use Games\Games\Domain\Transformer\Exception\TransformerNotFound;
use Games\Games\Domain\Transformer\Service\ServiceTransformer;
use Games\Games\Infrastructure\Logger\MonologLogger;
use Games\Games\Infrastructure\Middleware\TransformXMLToArray;
use Games\Games\Infrastructure\Transformer\TransformerArrayToXMLService;
use Games\Games\Infrastructure\Transformer\TransformerXMLToStringService;
use Illuminate\Http\Request;
use Tests\IntegrationTest;

final class TransformXMLToArrayTest extends IntegrationTest
{
    private const XML_ROUTE = 'example.xml';
    private TransformXMLToArray $transformerXMLToArray;
    private $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->initializeTransformerXMLToArray();
    }

    /** @test */
    public function handleTransformXmlToArrayWithCorrectResponse(): void
    {
        // Given
        $this->initializeValues(self::XML_ROUTE);

        // When
        $this->transformerXMLToArray->handle($this->request, function ($req) {

            // Then
            $this->assertNotNull($req);
            $this->assertSame($this->buildType(), $req->type);
            $this->assertSame($this->buildUuid(), $req->uuid);
            $this->assertSame($this->buildXML(), $req->xml);
        });
    }

    private function initializeTransformerXMLToArray(): void
    {
        $serviceTransformer = new ServiceTransformer(
            new TransformerArrayToXMLService(),
            new TransformerXMLToStringService(),
            new MonologLogger()
        );

        $transformerService = new TransformerService(
            $serviceTransformer
        );

        $this->transformerXMLToArray = new TransformXMLToArray(
            $transformerService
        );
    }

    private function buildUser(): array
    {
        return [
            "uuid" => "e335ba19-2315-4753-9d78-7650ab644c4f",
            "name" => "Nombre del usuario",
            "surname" => "Nombre del usuario",
            "address" => "javi.noguera@icloud.com"
        ];
    }

    private function buildBody(): array
    {
        return [
            "uuid" => "e335ba19-2315-4753-9d78-7650ab644c4f",
            "address" => "jnogueramunoz@gmail.com",
            "subject" => "Este es el titulo del mensaje",
            "content" => "Hellos"
        ];
    }

    private function buildUuid(): string
    {
        return '6062fea5-cc05-453b-8df2-e3fdaba5de6a';
    }

    private function buildType(): string
    {
        return 'count_request';
    }

    private function buildXML(): array
    {
        return [
            'uuid' => $this->buildUuid(),
            'type' => $this->buildType(),
            'user' => $this->buildUser(),
            'body' => $this->buildBody()
        ];
    }

    private function initializeValues(string $route): void
    {
        $this->request = new Request(
            [],
            [],
            [],
            [],
            [],
            [],
            file_get_contents($route, true)
        );
        $this->request->headers->set('Content-Type', 'application/xml');
    }
}
