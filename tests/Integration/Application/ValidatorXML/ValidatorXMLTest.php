<?php

namespace Tests\Integration\Application\ValidatorXML;

use Games\Games\Application\ValidatorXML\Request\ValidatorXMLRequest;
use Games\Games\Application\ValidatorXML\ValidatorXML;
use Games\Games\Infrastructure\Validator\ValidatorService;
use Tests\IntegrationTest;

class ValidatorXMLTest extends IntegrationTest
{
    private const TYPE = 'reverse_request';
    private const CONTENT = 'content';
    private const CONTENT_CORRECT = 'content';

    private ValidatorXML $validatorXML;
    private ValidatorXMLRequest $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->validatorXML = new ValidatorXML(
            new ValidatorService()
        );
    }

    /** @test */
    public function validatorXmlCorrect(): void
    {
        // Given
        $this->initializeValues(self::CONTENT_CORRECT);

        // When
        $response = $this->validatorXML->execute($this->request);

        // Then
        $this->assertFalse($response);
    }

    /** @test */
    public function validatorXmlIncorrect(): void
    {
        // Given
        $this->initializeValues(self::CONTENT);

        // When
        $response = $this->validatorXML->execute($this->request);

        // Then
        $this->assertFalse($response);
    }

    private function initializeValues(string $content): void
    {
        $this->request = ValidatorXMLRequest::build(
            self::TYPE,
            $content
        );
    }
}
