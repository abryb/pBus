<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Course
 *
 * @ORM\Table(name="course")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CourseRepository")
 */
class Course
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Station $departure
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Station", inversedBy="departures")
     * @ORM\JoinColumn(name="departure_code", referencedColumnName="code")
     */
    private $departure;

    /**
     * @var \AppBundle\Entity\Station $destination
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Station", inversedBy="arrivals")
     * @ORM\JoinColumn(name="destination_code", referencedColumnName="code")
     */
    private $destination;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="departure_date", type="datetime")
     */
    private $departureDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="arrival_date", type="datetime")
     */
    private $arrivalDate;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="decimal", precision=6, scale=2, nullable=true)
     */
    private $price;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set departure
     *
     * @param \AppBundle\Entity\Station $departure
     * @return Course
     */
    public function setDeparture($departure)
    {
        $this->departure = $departure;

        return $this;
    }

    /**
     * Get departure
     *
     * @return \AppBundle\Entity\Station $departure
     */
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * Set destination
     *
     * @param \AppBundle\Entity\Station $destination
     * @return Course
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return \AppBundle\Entity\Station $destination
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set price
     *
     * @param integer $price
     * @return Course
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set departureDate
     *
     * @param \DateTime $departureDate
     * @return Course
     */
    public function setDepartureDate($departureDate)
    {
        $this->departureDate = $departureDate;

        return $this;
    }

    /**
     * Get departureDate
     *
     * @return \DateTime 
     */
    public function getDepartureDate()
    {
        return $this->departureDate;
    }

    /**
     * Set arrivalDate
     *
     * @param \DateTime $arrivalDate
     * @return Course
     */
    public function setArrivalDate($arrivalDate)
    {
        $this->arrivalDate = $arrivalDate;

        return $this;
    }

    /**
     * Get arrivalDate
     *
     * @return \DateTime 
     */
    public function getArrivalDate()
    {
        return $this->arrivalDate;
    }
}
