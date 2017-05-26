<?php

namespace AppBundle\Util\PolskiBus;

use AppBundle\Entity\Station;

class CourseUpdater
{
    private $responseParser;

    public function __construct()
    {
        $this->responseParser = new ResponseParser();
    }

    public function updateConnection(Station $departure, Station $destination)
    {
        $dates = new \DateTime();
        $dates->modify('+20 days');

        $pbrequest = new RequestSender($departure, $destination, $dates);

        $responses =  $pbrequest->send();

        $courseDataObtainedArray = [];
        foreach ($responses as $response) {
            $courseDataObtainedArray = $this->responseParser->setResponse($response)->parse();
        }

        return $courseDataObtainedArray;
    }
}