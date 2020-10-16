<?php

namespace Tests\Integration\Application\AnswerMessage;

use Games\Games\Application\AnswerMessage\AnswerMessage;
use Games\Games\Application\AnswerMessage\Request\AnswerMessageRequest;
use Games\Games\Application\AnswerMessage\Response\AnswerMessageResponse;
use Games\Games\Domain\Base\Exceptions\AddressNotValid;
use Games\Games\Domain\Event\DomainEventPublisher;
use Games\Games\Domain\Mail\Events\MailSubscriber;
use Games\Games\Domain\Message\Events\BodyCreatedSubscriber;
use Games\Games\Domain\Transformer\Service\ServiceTransformer;
use Games\Games\Domain\User\UserCreatedSubscriber;
use Games\Games\Infrastructure\Domain\Event\SyncEventPublisher;
use Games\Games\Infrastructure\Logger\MonologLogger;
use Games\Games\Infrastructure\Mailer\MailerService;
use Games\Games\Infrastructure\Repository\Event\RepositoryEventStore;
use Games\Games\Infrastructure\Repository\Message\Entity\RepositoryMessage;
use Games\Games\Infrastructure\Repository\Message\ValueObjects\RepositoryBody;
use Games\Games\Infrastructure\Repository\User\RepositoryUser;
use Games\Games\Infrastructure\Transformer\TransformerArrayToXMLService;
use Games\Games\Infrastructure\Transformer\TransformerXMLToStringService;
use Tests\IntegrationTest;
use Tests\Unit\Application\AnswerMessage\MotherObject\AnswerMessageRequestMotherObject;
use Tests\Unit\Domain\Event\SpySubscriber;

class AnswerMessageTest extends IntegrationTest
{
    private AnswerMessage $answerMessage;
    private AnswerMessageRequest $answerMessageRequest;

    protected function setUp(): void
    {
        parent::setUp();

        $serviceTransformer = new ServiceTransformer(
            new TransformerArrayToXMLService(),
            new TransformerXMLToStringService(),
            new MonologLogger()
        );

        $mailSubscriber = new MailSubscriber(
            new MailerService()
        );

        $userCreatedSubscriber = new UserCreatedSubscriber(
            new RepositoryUser()
        );

        $bodySubscriber = new BodyCreatedSubscriber(
            new RepositoryBody()
        );

        $subscriber = [
            $mailSubscriber,
            $userCreatedSubscriber,
            $bodySubscriber
        ];

        $syncEventPublisher = new SyncEventPublisher(
            new RepositoryEventStore(),
            ...$subscriber
        );

        $messageRepository = new RepositoryMessage();

        $this->answerMessage = new AnswerMessage(
            $serviceTransformer,
            $messageRepository,
            $syncEventPublisher
        );
    }

    /** @test */
    public function answerMessageCorrectFormInCountMessage(): void
    {
        // Given
        $request = AnswerMessageRequestMotherObject::buildCountMessage();
        $this->initializeValues($request);

        // When
        $response = $this->answerMessage->execute($this->answerMessageRequest);

        // Then
        $this->assertInstanceOf(AnswerMessageResponse::class, $response);
    }

    /** @test */
    public function answerMessageCorrectFormInReverseMessage(): void
    {
        // Given
        $request = AnswerMessageRequestMotherObject::buildReverseMessage();
        $this->initializeValues($request);

        // When
        $response = $this->answerMessage->execute($this->answerMessageRequest);

        // Then
        $this->assertInstanceOf(AnswerMessageResponse::class, $response);
    }

    /** @test */
    public function answerMessageCorrectFormInCountMessageThrowAddressInvalidException(): void
    {
        // Given
        $request = AnswerMessageRequestMotherObject::buildCountMessageErrorAddress();
        $this->initializeValues($request);

        // Then
        $this->expectException(AddressNotValid::class);

        // When
        $this->answerMessage->execute($this->answerMessageRequest);
    }

    private function initializeValues(AnswerMessageRequest $request): void
    {
        $this->answerMessageRequest = AnswerMessageRequest::create(
            $request->getUuid(),
            $request->getUser(),
            $request->getBody(),
            $request->getType()
        );
    }
}
