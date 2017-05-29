<?php

namespace AppBundle\Util\PolskiBus;

use AppBundle\Entity\Station;
use AppBundle\Entity\Course;
use AppBundle\Util\PolskiBus\Parser\ConnectionParser;
use AppBundle\Util\PolskiBus\Parser\ResponseParser;
use AppBundle\Util\PolskiBus\Parser\StationParser;

class PolskiBus
{
    private $requestSender;

    /**
     * PolskiBus constructor.
     */
    public function __construct()
    {
        $this->requestSender = new RequestSender();
    }

    public function getStations()
    {
        $reponse = $this->requestSender->checkStations();
        $responseParser = new ResponseParser($reponse);
        $responseParser->setParser(new StationParser());
        return $responseParser->parse();
    }

    public function getConnections()
    {
        $reponse = $this->requestSender->checkConnections();
        $responseParser = new ResponseParser($reponse);
        $responseParser->setParser(new ConnectionParser());
        return $responseParser->parse();
    }
}