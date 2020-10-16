<?php

namespace Games\Games\Application\ValidatorXML;

use Games\Games\Application\ValidatorXML\Request\ValidatorXMLRequest;
use Games\Games\Domain\Validator\Validator;

final class ValidatorXML
{
    private Validator $interfaceValidator;

    public function __construct(Validator $interfaceValidator)
    {
        $this->interfaceValidator = $interfaceValidator;
    }

    public function execute(ValidatorXMLRequest $request): bool
    {
        return $this->interfaceValidator->xml($request->getContent(), $request->getType());
    }
}
