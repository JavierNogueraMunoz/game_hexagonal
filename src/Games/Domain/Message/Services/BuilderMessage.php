<?php

namespace Games\Games\Domain\Message\Services;

use Games\Games\Application\AnswerMessage\Request\AnswerMessageRequest;
use Games\Games\Domain\Mail\ValueObject\AddressMail;
use Games\Games\Domain\Message\Entity\Message;
use Games\Games\Domain\Message\FactoryMessage;
use Games\Games\Domain\Message\Entity\Body;
use Games\Games\Domain\Message\ValueObjects\BodyId;
use Games\Games\Domain\Message\ValueObjects\MessageId;
use Games\Games\Domain\User\User;
use Games\Games\Domain\User\UserId;

class BuilderMessage
{
    public static function get(AnswerMessageRequest $request): Message
    {
        return FactoryMessage::build(
            $request->getType(),
            MessageId::fromString($request->getUuid()),
            self::buildUser($request->getUser()),
            self::buildBody($request->getBody())
        );
    }

    private static function buildUser(array $user): User
    {
        $userId = UserId::fromString($user['uuid']);
        $addressMail = AddressMail::create($user['address']);

        return User::create(
            $userId,
            $addressMail,
            $user['name'],
            $user['surname']
        );
    }

    private static function buildBody(array $body): Body
    {
        $address = AddressMail::create($body['address']);
        $bodyId = BodyId::fromString($body['uuid']);

        return Body::create(
            $bodyId,
            $address,
            $body['subject'],
            $body['content']
        );
    }
}
