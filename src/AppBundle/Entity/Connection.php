<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Util\PolskiBus\Data\ConnectionData;

/**
 * Connection
 *
 * @ORM\Table(name="connection")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ConnectionRepository")
 * @ORM\HasLifecycleCallbacks
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
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var boolean
     * @ORM\Column(name="is_tracked", type="boolean", nullable=true)
     */
    private $isTracked;


    /**
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime('now'));
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

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return Connection
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * Set isTracked
     *
     * @param boolean $isTracked
     * @return Connection
     */
    public function setIsTracked($isTracked)
    {
        $this->isTracked = $isTracked;

        return $this;
    }

    /**
     * Get isTracked
     *
     * @return boolean 
     */
    public function getIsTracked()
    {
        return $this->isTracked;
    }
}
