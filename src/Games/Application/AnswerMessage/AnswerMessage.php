<?php

namespace Games\Games\Application\AnswerMessage;

use Games\Games\Application\AnswerMessage\Request\AnswerMessageRequest;
use Games\Games\Application\AnswerMessage\Response\AnswerMessageResponse;
use Games\Games\Domain\Event\DomainEventPublisher;
use Games\Games\Domain\Logger\LoggerService;
use Games\Games\Domain\Message\Entity\Message;
use Games\Games\Domain\Message\Repository\MessageRepository;
use Games\Games\Domain\Message\Services\BuilderMessage;
use Games\Games\Domain\Transformer\Entity\Content;
use Games\Games\Domain\Transformer\Entity\Transformer;
use Games\Games\Domain\Transformer\Service\ServiceTransformer;

class AnswerMessage
{
    private const TRANSFORMER = 'arrayToXml';

    private ServiceTransformer $transformerService;
    private MessageRepository $messageRepository;
    private DomainEventPublisher $domainEventPublisher;

    public function __construct(
        ServiceTransformer $transformerService,
        MessageRepository $messageRepository,
        DomainEventPublisher $domainEventPublisher
    ) {
        $this->transformerService = $transformerService;
        $this->messageRepository = $messageRepository;
        $this->domainEventPublisher = $domainEventPublisher;
    }

    public function execute(AnswerMessageRequest $request): AnswerMessageResponse
    {
        $message = BuilderMessage::get($request);

        $answer = $this->getAnswer($message);

        $this->messageRepository->save($message);

        $this->domainEventPublisher->publish(...$message->pullEvents());

        return AnswerMessageResponse::create($answer);
    }

    private function getAnswer(Message $message): string
    {
        $transformer = $this->createTransformer($message);
        return $this->transformerService->execute($transformer);
    }

    private function createTransformer(Message $message): Transformer
    {
        return Transformer::build(
            self::TRANSFORMER,
            $this->createContent($message->getResponse())
        );
    }

    private function createContent($content): Content
    {
        return Content::build($content);
    }
}
