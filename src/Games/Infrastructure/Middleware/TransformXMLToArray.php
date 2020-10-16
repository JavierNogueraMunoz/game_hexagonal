<?php

namespace Games\Games\Infrastructure\Middleware;

use Closure;
use Exception;
use Games\Games\Application\Transformer\Request\TransformerRequest;
use Games\Games\Application\Transformer\TransformerService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class TransformXMLToArray
{
    private const XML_TO_STRING = 'xmlToString';
    private const EMPTY = '';

    private TransformerService $transformer;

    public function __construct(TransformerService $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return Closure | Response
     * @throws Exception
     */
    public function handle($request, Closure $next)
    {
        $transformerRequest = $this->buildTransformerRequest($request);
        $xml = $this->transformer->execute($transformerRequest);

        $request->type = $xml['type'];
        $request->uuid = $xml['uuid'];
        $request->xml = $xml;

        return $next($request);
    }

    private function buildTransformerRequest($request): TransformerRequest
    {
        return TransformerRequest::build(
            self::XML_TO_STRING,
            $request->getContent()
        );
    }
}
