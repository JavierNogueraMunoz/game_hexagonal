<?php

namespace Games\Games\Domain\Message\Entity;

use Games\Games\Domain\Base\Id\UUIDv4;
use Games\Games\Domain\Message\Events\CountMessageEvent;
use Games\Games\Domain\Message\ValueObjects\MessageId;
use Games\Games\Domain\User\User;

final class CountMessage extends Message
{
    private const RESPONSE = 'count_response';

    private function __construct(
        MessageId $countMessageId,
        User $user,
        Body $body
    ) {
        parent::__construct($countMessageId, $user, $body);

        $this->generateEvent();
    }

    public static function build(
        MessageId $countMessageId,
        User $user,
        Body $body
    ): CountMessage {
        return new static($countMessageId, $user, $body);
    }

    private function generateEvent(): void
    {
        $this->recordThat(
            $this->buildEvent()
        );
    }

    private function buildEvent(): CountMessageEvent
    {
        return CountMessageEvent::build(
            UUIDv4::generate(),
            $this
        );
    }

    public function getResponse(): array
    {
        return [
            self::RESPONSE => [
                'body' => $this->getCountBodyResponse()
            ]
        ];
    }

    private function getCountBodyResponse(): array
    {
        return $this->getBody()->getResponseCountText();
    }
}
