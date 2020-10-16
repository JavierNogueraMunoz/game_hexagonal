<?php

namespace Games\Games\Infrastructure\Middleware;

use Closure;
use Exception;
use Games\Games\Application\ValidatorXML\Request\ValidatorXMLRequest;
use Games\Games\Application\ValidatorXML\ValidatorXML;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class ValidateXML
{
    private ValidatorXML $validatorXML;

    public function __construct(ValidatorXML $validatorXML)
    {
        $this->validatorXML = $validatorXML;
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return Closure | Response
     * @throws Exception
     */
    public function handle($request, Closure $next)
    {
        if (!$this->validatorXML->execute(
            $this->buildValidateRequest($request)
        )) {
            return (new Response())->setContent('');
        }

        return $next($request);
    }

    private function buildValidateRequest($request): ValidatorXMLRequest
    {
        return ValidatorXMLRequest::build(
            $request->type,
            $request->getContent()
        );
    }
}
