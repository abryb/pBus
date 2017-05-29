<?php

namespace AppBundle\Util\PolskiBus\Parser;


class ResponseParser
{
    private $response;

    public $parser;

    public function __construct($response)
    {
        $this->response = $response;
    }

    public function parse()
    {
        if (!$this->parser) {
            throw new \LogicException('Comparator is not set');
        }

        return $this->parser->parse($this->response);
    }

    public function setParser($parser)
    {
        $this->parser = $parser;
    }
}