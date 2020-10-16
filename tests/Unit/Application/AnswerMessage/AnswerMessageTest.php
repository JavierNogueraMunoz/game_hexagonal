<?php

namespace Tests\Unit\Application\AnswerMessage;

use Games\Games\Application\AnswerMessage\AnswerMessage;
use Games\Games\Application\AnswerMessage\Request\AnswerMessageRequest;
use Games\Games\Application\AnswerMessage\Response\AnswerMessageResponse;
use Games\Games\Domain\Transformer\Service\ServiceTransformer;
use Games\Games\Infrastructure\Logger\MonologLogger;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Application\AnswerMessage\MotherObject\AnswerMessageRequestMotherObject;
use Tests\Unit\Infrastructure\InMemory\InMemoryRepositoryMessage;
use Tests\Unit\Infrastructure\Stub\Event\SyncEventPublisherStub;
use Tests\Unit\Infrastructure\Stub\Logger\MonologgerStub;
use Tests\Unit\Infrastructure\Stub\Transformer\TransformerArrayToXMLStub;
use Tests\Unit\Infrastructure\Stub\Transformer\TransformerXMLToStringStub;

final class AnswerMessageTest extends TestCase
{
    private AnswerMessage $answerMessage;
    private AnswerMessageRequest $answerMessageRequest;

    protected function setUp(): void
    {
        parent::setUp();

        $transformerService = new ServiceTransformer(
            new TransformerArrayToXMLStub(),
            new TransformerXMLToStringStub(),
            new MonologgerStub()
        );

        $inMemoryMessageRepository = new InMemoryRepositoryMessage();

        $syncEventPublisherStub = new SyncEventPublisherStub();

        $this->answerMessage = new AnswerMessage(
            $transformerService,
            $inMemoryMessageRepository,
            $syncEventPublisherStub
        );
    }

    /** @test */
    public function answerMessageCorrectForm(): void
    {
        // Given
        $this->initializeValues();

        // When
        $response = $this->answerMessage->execute($this->answerMessageRequest);

        // Then
        $this->assertInstanceOf(AnswerMessageResponse::class, $response);
    }

    private function initializeValues(): void
    {
        $this->answerMessageRequest = AnswerMessageRequestMotherObject::buildCountMessage();
    }
}
