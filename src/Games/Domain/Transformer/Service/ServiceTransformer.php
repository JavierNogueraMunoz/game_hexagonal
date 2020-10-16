<?php

namespace Games\Games\Domain\Transformer\Service;

use Games\Games\Domain\Logger\Entity\Log;
use Games\Games\Domain\Logger\LoggerService;
use Games\Games\Domain\Transformer\Entity\Transformer;
use Games\Games\Domain\Transformer\Exception\TransformerNotFound;
use Games\Games\Domain\Transformer\TransformerArrayToXML;
use Games\Games\Domain\Transformer\TransformerXMLToString;

class ServiceTransformer
{
    private const ARRAY_TO_XML = 'arrayToXml';
    private const XML_TO_STRING = 'xmlToString';
    private const TYPES = [
        self::ARRAY_TO_XML,
        self::XML_TO_STRING
    ];

    private TransformerArrayToXML $transformerArrayToXML;
    private TransformerXMLToString $transformerXMLToString;
    private LoggerService $loggerService;

    public function __construct(
        TransformerArrayToXML $transformerArrayToXML,
        TransformerXMLToString $transformerXMLToString,
        LoggerService $loggerService
    ) {
        $this->transformerArrayToXML = $transformerArrayToXML;
        $this->transformerXMLToString = $transformerXMLToString;
        $this->loggerService = $loggerService;
    }

    /**
     * @param Transformer $transformer
     * @return array|string
     * @throws TransformerNotFound
     */
    public function execute(Transformer $transformer)
    {
        if (!in_array($transformer->getType(), self::TYPES)) {
            $this->throwTransformerException();
        }

        if ($transformer->getType() === self::ARRAY_TO_XML) {
            return $this->transformerArrayToXML->get($transformer);
        }

        return $this->transformerXMLToString->get($transformer);
    }

    /**
     * @throws TransformerNotFound
     */
    private function throwTransformerException(): void
    {
        $exception = TransformerNotFound::create();
        $log = $this->buildLog(
            $exception->getMessage()
        );

        $this->loggerService->critical($log);

        throw $exception;
    }

    private function buildLog(string $message): Log
    {
        return Log::build($message, []);
    }
}
