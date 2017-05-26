<?php
/**
 * Created by PhpStorm.
 * User: bazej
 * Date: 25.05.17
 * Time: 22:26
 */

namespace AppBundle\Util\PolskiBus;

use AppBundle\Entity\Station;

class CourseData
{
    /**
     * @var \AppBundle\Entity\Station $departure;
     */
    private $departure;

    /**
     * @var \AppBundle\Entity\Station $destination;
     */
    private $destination;

    /**
     * @var \DateTime $departureDate
     */
    private $departureDate;

    /**
     * @var \DateTime $arrivalDate
     */
    private $arrivalDate;

    /**
     * @var float $price
     */
    private $price;

    /**
     * @return Station
     */
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * @param Station $departure
     * @return CourseData
     */
    public function setDeparture($departure)
    {
        $this->departure = $departure;
        return $this;
    }

    /**
     * @return Station
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param Station $destination
     * @return CourseData
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDepartureDate()
    {
        return $this->departureDate;
    }

    /**
     * @param \DateTime $departureDate
     * @return CourseData
     */
    public function setDepartureDate($departureDate)
    {
        $this->departureDate = $departureDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getArrivalDate()
    {
        return $this->arrivalDate;
    }

    /**
     * @param \DateTime $arrivalDate
     * @return CourseData
     */
    public function setArrivalDate($arrivalDate)
    {
        $this->arrivalDate = $arrivalDate;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return CourseData
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

}