<?php

namespace Games\Games\Application\Transformer;

use Games\Games\Application\Transformer\Request\TransformerRequest;
use Games\Games\Domain\Transformer\Entity\Content;
use Games\Games\Domain\Transformer\Entity\Transformer;
use Games\Games\Domain\Transformer\Service\ServiceTransformer;

final class TransformerService
{
    private ServiceTransformer $serviceTransformer;

    public function __construct(ServiceTransformer $serviceTransformer)
    {
        $this->serviceTransformer = $serviceTransformer;
    }

    public function execute(TransformerRequest $request)
    {
        $transformer = $this->buildTransformer($request);

        return $this->serviceTransformer->execute($transformer);
    }

    private function buildTransformer(TransformerRequest $request): Transformer
    {
        $content = Content::build($request->getContent());

        return Transformer::build(
            $request->getType(),
            $content
        );
    }
}
