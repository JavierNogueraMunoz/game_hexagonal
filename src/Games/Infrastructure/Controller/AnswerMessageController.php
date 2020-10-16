<?php

namespace Games\Games\Infrastructure\Controller;

use Games\Games\Application\AnswerMessage\AnswerMessage;
use Games\Games\Application\AnswerMessage\Request\AnswerMessageRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class AnswerMessageController
{
    public function __invoke(AnswerMessage $transformationMessage, Request $request): Response
    {
        return (new Response())
            ->setContent(
                $transformationMessage->execute(
                    AnswerMessageRequest::create(
                        $request->uuid,
                        $request->xml['user'],
                        $request->xml['body'],
                        $request->type
                    )
                )->getMessage()
            );
    }
}
