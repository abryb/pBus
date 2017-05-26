<?php
/**
 * Created by PhpStorm.
 * User: bazej
 * Date: 25.05.17
 * Time: 22:26
 */

namespace AppBundle\Util\PolskiBus;



class CourseDataObtained
{
    private $departure;

    private $destination;

    private $departureDate;

    private $arrivalDate;

    private $price;

    /**
     * @return mixed
     */
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * @param mixed $departure
     * @return CourseDataObtained
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
     * @return CourseDataObtained
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDepartureDate()
    {
        return $this->departureDate;
    }

    /**
     * @param mixed $departureDate
     * @return CourseDataObtained
     */
    public function setDepartureDate($departureDate)
    {
        $this->departureDate = $departureDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getArrivalDate()
    {
        return $this->arrivalDate;
    }

    /**
     * @param mixed $arrivalDate
     * @return CourseDataObtained
     */
    public function setArrivalDate($arrivalDate)
    {
        $this->arrivalDate = $arrivalDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     * @return CourseDataObtained
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
}