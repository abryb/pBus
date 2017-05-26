<?php

namespace AppBundle\Util\PolskiBus;

use AppBundle\Entity\Station;
use AppBundle\Entity\Course;

class CourseUpdater
{
    /**
     * @var ResponseParser
     */
    private $responseParser;

    /**
     * CourseUpdater constructor.
     */
    public function __construct()
    {
        $this->responseParser = new ResponseParser();
    }

    /**
     * @param Station $departure
     * @param Station $destination
     * @param $dates
     * @return array
     * Return array of CourseData objects
     */
    public function update(Station $departure, Station $destination, $dates)
    {
        // Create requestSender to www.polskibus.com
        $requestSender = new RequestSender($departure, $destination, $dates);
        // Send request
        $responses = $requestSender->send();

        // Array of CourseData objects to return
        $courseDataArray = [];
        foreach ($responses as $response) {
            // $parsedResponse is array of CourseData objects
            $parsedResponse = $this->responseParser->setResponse($response)->parse();
            // merge arrays, to avoid 2-dim arrays,  and always get 1-dimensional
            $courseDataArray = array_merge($courseDataArray, $parsedResponse);
        }
        return $courseDataArray;
    }
}