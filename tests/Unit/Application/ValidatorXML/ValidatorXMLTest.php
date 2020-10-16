<?php

namespace Tests\Unit\Application\ValidatorXML;

use Games\Games\Application\ValidatorXML\Request\ValidatorXMLRequest;
use Games\Games\Application\ValidatorXML\ValidatorXML;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Infrastructure\Stub\Validator\ValidatorStub;

final class ValidatorXMLTest extends TestCase
{
    private const TYPE = 'reverse_request';
    private const CONTENT = 'content';

    private ValidatorXML $validatorXML;
    private ValidatorXMLRequest $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->validatorXML = new ValidatorXML(
            new ValidatorStub()
        );
    }

    /** @test */
    public function validatorXML(): void
    {
        // Given
        $this->initializeValues();

        // When
        $response = $this->validatorXML->execute($this->request);

        // Then
        $this->assertTrue($response);
    }

    private function initializeValues(): void
    {
        $this->request = ValidatorXMLRequest::build(
            self::TYPE,
            self::CONTENT
        );
    }
}
