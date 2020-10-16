<?php

namespace Games\Games\Infrastructure\Transformer;

use DOMDocument;
use Games\Games\Domain\Transformer\Entity\Transformer;
use Games\Games\Domain\Transformer\TransformerArrayToXML;

class TransformerArrayToXMLService implements TransformerArrayToXML
{
    private DOMDocument $xml;

    public function get(Transformer $transformer): string
    {
        $message = $transformer->getContentEntity();
        $this->setXML();
        $this->constructXML($message, $this->xml);
        $this->xml->formatOutput = true;
        return $this->xml->saveXML();
    }

    private function setXML(): void
    {
        $this->xml = new DOMDocument();
        $this->xml->encoding = 'UTF-8';
        $this->xml->xmlVersion = '1.0';
        $this->xml->formatOutput = true;
    }

    private function constructXML($array, $element): void
    {
        foreach($array as $tag => $value)
        {
            is_array($value) ?
                $this->generateNode($element,$tag, $value):
                $this->generateNodeWithValue($element,$tag, $value);
        }
    }
    private function generateNodeWithValue($elementFather, string $tag, string $value): void
    {
        $elementFather->appendChild($this->xml->createElement($tag, $value));
    }

    private function generateNode($elementFather, string $tag, $value): void
    {
        $elementChild = $this->xml->createElement($tag);
        $elementFather->appendChild($elementChild);
        $this->constructXML($value, $elementChild);
    }
}
