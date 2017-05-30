<?php
/**
 * Created by PhpStorm.
 * User: bazej
 * Date: 29.05.17
 * Time: 18:54
 */

namespace AppBundle\Util\PolskiBus\Data;

use AppBundle\Entity\Station;

class ConnectionData
{
    /**
     * @var Station $departure
     */
    private $departure;

    /**
     * @var Station $destination
     */
    private $destination;

    /**
     * @var \DateTime
     */
    private $lastDate;


    /**
     * @return Station
     */
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * @param Station $departure
     * @return ConnectionData
     */
    public function setDeparture($departure)
    {
        $this->departure = $departure;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param mixed $destination
     * @return ConnectionData
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLastDate()
    {
        return $this->lastDate;
    }

    /**
     * @param \DateTime $lastDate
     * @return ConnectionData
     */
    public function setLastDate($lastDate)
    {
        $this->lastDate = $lastDate;
        return $this;
    }
}