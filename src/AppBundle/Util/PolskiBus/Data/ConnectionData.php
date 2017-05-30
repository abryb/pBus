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
     * @var Station $departureCode
     */
    private $departureCode;

    /**
     * @var Station $destinationCode
     */
    private $destinationCode;

    /**
     * @var \DateTime
     */
    private $lastDate;


    /**
     * @return Station
     */
    public function getDepartureCode()
    {
        return $this->departureCode;
    }

    /**
     * @param Station $departureCode
     * @return ConnectionData
     */
    public function setDepartureCode($departureCode)
    {
        $this->departureCode = $departureCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDestinationCode()
    {
        return $this->destinationCode;
    }

    /**
     * @param mixed $destinationCode
     * @return ConnectionData
     */
    public function setDestinationCode($destinationCode)
    {
        $this->destinationCode = $destinationCode;
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