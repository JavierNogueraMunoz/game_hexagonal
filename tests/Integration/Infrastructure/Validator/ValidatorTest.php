<?php

namespace Tests\Integration\Infrastructure\Validator;

use Games\Games\Infrastructure\Validator\ValidatorService;
use Tests\IntegrationTest;

class ValidatorTest extends IntegrationTest
{
    private const ROUTE = 'XSD/example.xml';
    private const ERROR = 'XSD/error.xml';
    private string $xml;
    private string $type;
    private ValidatorService $validator;

    /** @test */
    public function validateXmlWhenIsCorrect(): void
    {
        // Given
        $this->initializeValues(self::ROUTE);

        // When
        $validate = $this->validator->xml(
            $this->xml,
            $this->type
        );

        // Then
        $this->assertTrue($validate);
    }

    /** @test */
    public function validateXmlWhenIsIncorrect(): void
    {
        // Given
        $this->initializeValues(self::ERROR);

        // When
        $validate = $this->validator->xml(
            $this->xml,
            $this->type
        );

        // Then
        $this->assertFalse($validate);
    }

    private function initializeValues(string $route): void
    {
        $this->xml = file_get_contents($route, true);
        $this->type = simplexml_load_string($this->xml)->type;
        $this->validator = new ValidatorService();
    }
}
