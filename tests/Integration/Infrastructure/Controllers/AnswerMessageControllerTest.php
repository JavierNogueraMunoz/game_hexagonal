<?php

namespace Tests\Integration\Infrastructure\Controllers;

use Games\Games\Application\AnswerMessage\AnswerMessage;
use Games\Games\Domain\Mail\Events\MailSubscriber;
use Games\Games\Domain\Transformer\Service\ServiceTransformer;
use Games\Games\Infrastructure\Controller\AnswerMessageController;
use Games\Games\Infrastructure\Domain\Event\SyncEventPublisher;
use Games\Games\Infrastructure\Logger\MonologLogger;
use Games\Games\Infrastructure\Mailer\MailerService;
use Games\Games\Infrastructure\Repository\Event\RepositoryEventStore;
use Games\Games\Infrastructure\Repository\Message\Entity\RepositoryMessage;
use Games\Games\Infrastructure\Transformer\TransformerArrayToXMLService;
use Games\Games\Infrastructure\Transformer\TransformerXMLToStringService;
use Illuminate\Http\Request;
use Tests\Integration\Infrastructure\Mailer\MailerServiceStub;
use Tests\IntegrationTest;

final class AnswerMessageControllerTest extends IntegrationTest
{
    private const UUID = '6062fea5-cc05-453b-8df2-e3fdaba5de6a';
    private const TYPE = 'count_request';
    private const USER = [
        "uuid" => "e335ba19-2315-4753-9d78-7650ab644c4f",
        "name" => "Nombre del usuario",
        "surname" => "Nombre del usuario",
        "address" => "javi.noguera@icloud.com"
    ];
    private const BODY = [
        "uuid" => "e335ba19-2315-4753-9d78-7650ab644c8f",
        'address' => 'jnogueramunoz@gmail.com',
        'subject' => 'Este es el titulo del mensaje',
        'content' => 'Hellos'
    ];
    private const ROUTE = 'example.xml';
    private const CODE_SUCCESS = 200;

    private AnswerMessageController $answerMessageController;
    private AnswerMessage $answerMessage;
    private Request $request;

    protected function setUp(): void
    {
        parent::setUp();

        $serviceTransformer = new ServiceTransformer(
            new TransformerArrayToXMLService(),
            new TransformerXMLToStringService(),
            new MonologLogger()
        );

        $emailSubscriber = new MailSubscriber(
            new MailerServiceStub()
        );

        $syncEventPublisher = new SyncEventPublisher(
            new RepositoryEventStore(),
            $emailSubscriber
        );

        $this->answerMessage = new AnswerMessage(
            $serviceTransformer,
            new RepositoryMessage(),
            $syncEventPublisher
        );

        $this->answerMessageController = new AnswerMessageController();
    }

    /** @test */
    public function answerMessageControllerReturnAnswerMessageResponse(): void
    {
        // Given
        $this->initializeValues(
            self::UUID,
            self::USER,
            self::BODY,
            self::TYPE
        );

        // when
        $response = $this->answerMessageController->__invoke(
            $this->answerMessage,
            $this->request
        );

        // Then
        $this->assertEquals(self::CODE_SUCCESS, $response->getStatusCode());
    }



    private function initializeValues(string $uuid, array $user, array $body, string $type): void
    {
        $this->request = $this->initRequest(self::ROUTE);

        $this->request->uuid = $uuid;
        $this->request->xml = [
            'uuid' => $uuid,
            'type' => $type,
            'user' => $user,
            'body' => $body
        ];
        $this->request->type = $type;
    }

    private function initRequest(string $route): Request
    {
        $request = new Request(
            [],
            [],
            [],
            [],
            [],
            [],
            file_get_contents($route, true)
        );
        $request->headers->set('Content-Type', 'application/xml');

        return $request;
    }
}
