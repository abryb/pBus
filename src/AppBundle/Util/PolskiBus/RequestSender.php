<?php

namespace AppBundle\Util\PolskiBus;

use \Curl\MultiCurl;
use AppBundle\Entity\Station;
use AppBundle\Entity\Connection;
use \Curl\Curl;

/*
 * This class is heavily dependent on www.polskibus.com
 */
class RequestSender
{
    const URL_COURSE = 'https://booking.polskibus.com/Pricing/GetPrice';
    const URL_CONNECTIONS = 'https://booking.polskibus.com/Pricing/SelectionsDynamic';
    const URL_STATIONS = 'https://booking.polskibus.com/Pricing/SelectionsDynamic';
    const DATE_FORMAT = 'd/m/Y'; // format of date accept by site

    /**
     * @var array
     */
    private $courseData = array(
        'PricingForm.Adults' => '1',
        'PricingForm.FromCity' => '%departureCode%', //eg '29'
        'PricingForm.ToCity' => '%destinationCode%', // eg '2'
        'PricingForm.OutDate' => '%Date%', //eg '24/06/2017'
    );


    /**
     * RequestSender constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return array
     */
    public function checkCourses(Connection $connection)
    {
        $departure = $connection->getDeparture();
        $destination = $connection->getDestination();

        $dates = new \DatePeriod(
            $connection->getFirstDate(),
            new \DateInterval('P1D'),
            $connection->getLastDate()
        );

        // result to return
        $responses = [];

        $multi_curl = new MultiCurl(self::URL_COURSE);
        // set mutli_curl to follow, it's necessary because www.polskibus.com redirects with 303
        $multi_curl->setOpt(CURLOPT_FOLLOWLOCATION, true);
        // create succes function, runnin after single request, put responses to array
        $multi_curl->success(function($instance) use (&$responses) {
            $responses[] = $instance->response;
        });
        // multi_curl error and complete comment out to remember
//        $multi_curl->error(function($instance) {
//            echo 'call to "' . $instance->url . '" was unsuccessful.' . "\n";
//            echo 'error code: ' . $instance->errorCode . "\n";
//            echo 'error message: ' . $instance->errorMessage . "\n";
//        });
//        $multi_curl->complete(function($instance) {
//            echo 'call completed' . "\n";
//        });

        // set values of post courseData: departure and arrival code
        $this->setDepartureCode($departure);
        $this->setDestinationCode($destination);
        // add curls to queue
        $counter = 0;
        foreach ($dates as $date) {
            if ($counter == 5) break;
            // set post courseData date
            $this->setDataDate($date);
            // multi curl with second parameter 'true' - follow with post
            $multi_curl->addPost($this->courseData, true);
            $counter++;
        }

        $multi_curl->start();

        // return array of results - htmlcode
        return $responses;
    }

    public function checkConnections()
    {
        $curl = new Curl();
        $response = $curl->get(self::URL_CONNECTIONS);
        return $response;
    }

    public function checkStations()
    {
        $curl = new Curl();
        $response = $curl->get(self::URL_CONNECTIONS);
        return $response;
    }

    /**
     * @param Station $departure
     */
    private function setDepartureCode(Station $departure)
    {
        $this->courseData['PricingForm.FromCity'] = $departure->getCode();
    }

    /**
     * @param Station $destination
     */
    private function setDestinationCode(Station $destination)
    {
        $this->courseData['PricingForm.ToCity'] = $destination->getCode();
    }

    /**
     * @param \DateTime $date
     */
    private function setDataDate(\DateTime $date)
    {
        $this->courseData['PricingForm.OutDate'] = $date->format(RequestSender::DATE_FORMAT);
    }
}