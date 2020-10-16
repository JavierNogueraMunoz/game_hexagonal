<?php

namespace Tests\Integration\Infrastructure\Middleware;

use Games\Games\Application\Transformer\TransformerService;
use Games\Games\Application\ValidatorXML\ValidatorXML;
use Games\Games\Domain\Transformer\Service\ServiceTransformer;
use Games\Games\Domain\Validator\XMLNotValid;
use Games\Games\Infrastructure\Middleware\TransformXMLToArray;
use Games\Games\Infrastructure\Middleware\ValidateXML;
use Games\Games\Infrastructure\Transformer\TransformerArrayToXMLService;
use Games\Games\Infrastructure\Transformer\TransformerXMLToStringService;
use Games\Games\Infrastructure\Validator\ValidatorService;
use Illuminate\Http\Request;
use Tests\IntegrationTest;

final class ValidateXMLTest  extends IntegrationTest
{
    private const XML_ROUTE = 'example.xml';
    private const XML_ROUTE_ERROR = 'error.xml';

    private const COUNT_REQUEST = 'count_request';
    private const CONTENT = '';

    private ValidateXML $validateXML;
    private Request $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->initializeValidatorXML();
    }

    /** @test */
    public function validateXmlWithMiddlewareWithResponseOk(): void
    {
        // Given
        $this->initializeValues(self::XML_ROUTE);

        // When
        $this->validateXML->handle($this->request, function ($reqValidatorXML) {
            // Then
            $this->assertNotNull($reqValidatorXML);
            $this->assertSame($this->request->getContent(), $reqValidatorXML->getContent());
        });
    }

    /** @test */
    public function validateXmlWithMiddlewareThrowExceptionNotValidXML(): void
    {
        // Given
        $this->initializeValues(self::XML_ROUTE_ERROR);

        // When
        $response = $this->validateXML->handle($this->request, function ($reqValidatorXML) {});

        // Then
        $this->assertNotNull($response);
        $this->assertEquals(self::CONTENT, $response->getContent());
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
        $this->request->type = self::COUNT_REQUEST;
    }

    private function initializeValidatorXML(): void
    {
        $validatorXML = new ValidatorXML(
            new ValidatorService()
        );

        $this->validateXML = new ValidateXML(
            $validatorXML
        );
    }
}
