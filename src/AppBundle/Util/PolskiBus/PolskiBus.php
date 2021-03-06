<?php

namespace AppBundle\Util\PolskiBus;

use AppBundle\Entity\Station;
use AppBundle\Entity\Course;
use AppBundle\Entity\Connection;
use AppBundle\Util\PolskiBus\Parser\ConnectionParser;
use AppBundle\Util\PolskiBus\Parser\ResponseParser;
use AppBundle\Util\PolskiBus\Parser\StationParser;
use AppBundle\Util\PolskiBus\Parser\CourseParser;

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

    /**
     * @return mixed
     * Return array of stationData objects
     */
    public function getStations()
    {
        $reponse = $this->requestSender->checkStations();
        $responseParser = new ResponseParser($reponse);
        $responseParser->setParser(new StationParser());
        return $responseParser->parse();
    }

    /**
     * @return mixed
     * Return array of connectionData objects
     */
    public function getConnections()
    {
        $reponse = $this->requestSender->checkConnections();
        $responseParser = new ResponseParser($reponse);
        $responseParser->setParser(new ConnectionParser());
        return $responseParser->parse();
    }

    /**
     * @param Connection $connection
     * @return array
     * Return array of courseData objects
     */
    public function getCourses(Connection $connection, $dates)
    {
        $responses = $this->requestSender->checkCourses($connection, $dates);
        $result = [];
        foreach ($responses as $response) {
            $courseParser = new CourseParser();
            $result = array_merge($result, $courseParser->parse($response));
        }
        return $result;
    }
}