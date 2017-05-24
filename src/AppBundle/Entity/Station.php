<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Station
 *
 * @ORM\Table(name="station")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StationRepository")
 */
class Station
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Course", mappedBy="departure")
     */
    private $departures;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Course", mappedBy="destination")
     */
    private $arrivals;


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
     * Set name
     *
     * @param string $name
     * @return Station
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->departures = new \Doctrine\Common\Collections\ArrayCollection();
        $this->arrivals = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add departures
     *
     * @param \AppBundle\Entity\Course $departures
     * @return Station
     */
    public function addDeparture(\AppBundle\Entity\Course $departures)
    {
        $this->departures[] = $departures;

        return $this;
    }

    /**
     * Remove departures
     *
     * @param \AppBundle\Entity\Course $departures
     */
    public function removeDeparture(\AppBundle\Entity\Course $departures)
    {
        $this->departures->removeElement($departures);
    }

    /**
     * Get departures
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDepartures()
    {
        return $this->departures;
    }

    /**
     * Add arrivals
     *
     * @param \AppBundle\Entity\Course $arrivals
     * @return Station
     */
    public function addArrival(\AppBundle\Entity\Course $arrivals)
    {
        $this->arrivals[] = $arrivals;

        return $this;
    }

    /**
     * Remove arrivals
     *
     * @param \AppBundle\Entity\Course $arrivals
     */
    public function removeArrival(\AppBundle\Entity\Course $arrivals)
    {
        $this->arrivals->removeElement($arrivals);
    }

    /**
     * Get arrivals
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArrivals()
    {
        return $this->arrivals;
    }
}
