<?php

namespace AppBundle\Util\PolskiBus;

use \Curl\MultiCurl;
use AppBundle\Entity\Station;

/*
 * This class is heavily dependent on www.polskibus.com
 */
class RequestSender
{
    const URL = 'https://booking.polskibus.com/Pricing/GetPrice';
    const DATE_FORMAT = 'd/m/Y'; // format of date accept by site

    /**
     * @var MultiCurl
     */
    private $multi_curl;

    /**
     * @var array
     */
    private $data = array(
        'PricingForm.Adults' => '1',
        'PricingForm.FromCity' => '%departureCode%', //eg '29'
        'PricingForm.ToCity' => '%destinationCode%', // eg '2'
        'PricingForm.OutDate' => '%Date%', //eg '24/06/2017'
    );


    /**
     * @var \AppBundle\Entity\Station $departure
     */
    private $departure;

    /**
     * @var \AppBundle\Entity\Station $destination
     */
    private $destination;

    /**
     * @var array
     * Array of DateTime objects
     */
    private $dates;


    /**
     * RequestSender constructor.
     */
    public function __construct(Station $departure, Station $destination, $dates)
    {
        //create multi_curl and set url
        $this->multi_curl = new MultiCurl(RequestSender::URL);
        $this->setDeparture($departure);
        $this->setDestination($destination);
        if (!is_array($dates)) {
            $this->dates = [$dates];
        } else {
            $this->dates = $dates;
        }
    }

    /**
     * @return array
     */
    public function send()
    {
        // result to return
        $responses = [];

        // get multi_curl
        $multi_curl = $this->multi_curl;
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

        // set values of post data: departure and arrival code
        $this->setDepartureCode($this->departure);
        $this->setDestinationCode($this->destination);
        // add curls to queue
        foreach ($this->dates as $date) {
            // set post data date
            $this->setDataDate($date);
            // multi curl with second parameter 'true' - follow with post
            $multi_curl->addPost($this->data, true);
        }

        $multi_curl->start();

        // return array of results - htmlcode
        return $responses;
    }

    /**
     * @param Station $departure
     */
    private function setDepartureCode(Station $departure)
    {
        $this->data['PricingForm.FromCity'] = $departure->getCode();
    }

    /**
     * @param Station $destination
     */
    private function setDestinationCode(Station $destination)
    {
        $this->data['PricingForm.ToCity'] = $destination->getCode();
    }

    /**
     * @param \DateTime $date
     */
    private function setDataDate(\DateTime $date)
    {
        $this->data['PricingForm.OutDate'] = $date->format(RequestSender::DATE_FORMAT);
    }

    /**
     * @return \AppBundle\Entity\Station $departure
     */
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * @param \AppBundle\Entity\Station $departure
     * @return RequestSender
     */
    public function setDeparture($departure)
    {
        $this->departure = $departure;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Station $destination
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param \AppBundle\Entity\Station $destination
     * @return RequestSender
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
        return $this;
    }
}