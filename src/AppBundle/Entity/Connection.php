<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Connection
 *
 * @ORM\Table(name="connection")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ConnectionRepository")
 */
class Connection
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Station")
     * @ORM\JoinColumn(name="departure_code", referencedColumnName="code", onDelete="CASCADE")
     */
    private $departure;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Station")
     * @ORM\JoinColumn(name="destination_code", referencedColumnName="code", onDelete="CASCADE")
     */
    private $destination;

    /**
     * @var \DateTime
     * @ORM\Column(name="last_date", type="datetime")
     */
    private $lastDate;

    /**
     * @return \DateTime
     */
    public function getLastDate()
    {
        return $this->lastDate;
    }

    /**
     * @param \DateTime $lastDate
     * @return Connection
     */
    public function setLastDate($lastDate)
    {
        $this->lastDate = $lastDate;
        return $this;
    }

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
     * @return Connection
     */
    public function setDeparture(\AppBundle\Entity\Station $departure = null)
    {
        $this->departure = $departure;

        return $this;
    }

    /**
     * Get departure
     *
     * @return \AppBundle\Entity\Station 
     */
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * Set destination
     *
     * @param \AppBundle\Entity\Station $destination
     * @return Connection
     */
    public function setDestination(\AppBundle\Entity\Station $destination = null)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return \AppBundle\Entity\Station 
     */
    public function getDestination()
    {
        return $this->destination;
    }
}
