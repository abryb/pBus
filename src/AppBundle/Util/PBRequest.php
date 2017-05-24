<?php

namespace AppBundle\Util;

use \Curl\MultiCurl;

class PBRequest
{
    const URL = 'https://booking.polskibus.com/Pricing/GetPrice';

    /**
     * @var \Curl\MultiCurl $multiCurl
     */
    private $multiCurl;

    /**
     * @var \AppBundle\Entity\Station $departure
     */
    private $departure;

    /**
     * @var \AppBundle\Entity\Station $destination
     */
    private $destination;

    /**
     * PBRequest constructor.
     */
    public function __construct()
    {
        $this->multiCurl = new MultiCurl(PBRequest::URL);
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
     * @return PBRequest
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
     * @return PBRequest
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
        return $this;
    }
}