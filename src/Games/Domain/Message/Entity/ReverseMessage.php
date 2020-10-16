<?php

namespace Games\Games\Domain\Message\Entity;

use Games\Games\Domain\Base\Id\UUIDv4;
use Games\Games\Domain\Message\Events\ReverseMessageEvent;
use Games\Games\Domain\Message\ValueObjects\MessageId;
use Games\Games\Domain\User\User;

final class ReverseMessage extends Message
{
    private const RESPONSE = 'reverse_response';

    private function __construct(
        MessageId $reverseMessageId,
        User $user,
        Body $body
    ) {
        parent::__construct($reverseMessageId, $user, $body);

        $this->generateEvent();
    }

    public static function build(
        MessageId $reverseMessageId,
        User $user,
        Body $body
    ): ReverseMessage {
        return new static($reverseMessageId, $user, $body);
    }

    private function generateEvent(): void
    {
        $this->recordThat(
            $this->buildEvent()
        );
    }

    private function buildEvent(): ReverseMessageEvent
    {
        return ReverseMessageEvent::build(
            UUIDv4::generate(),
            $this
        );
    }

    public function getResponse(): array
    {
        return [
            self::RESPONSE => [
                'body' => $this->getReverseBodyResponse()
            ]
        ];
    }

    private function getReverseBodyResponse(): array
    {
        return $this->getBody()->getResponseReverseText();
    }
}
