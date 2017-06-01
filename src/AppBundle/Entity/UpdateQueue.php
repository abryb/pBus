<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Connection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * UpdateQueue
 *
 * @ORM\Table(name="update_queue")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UpdateQueueRepository")
 * @UniqueEntity(
 *     fields={"connection", "date"},
 *     errorPath="date",
 *     message="This port is already in use on that host."
 * )
 */
class UpdateQueue
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var Connection $connection
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Connection")
     * @ORM\JoinColumn(name="connection_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $connection;


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
     * Set date
     *
     * @param \DateTime $date
     * @return UpdateQueue
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set connection
     *
     * @param \AppBundle\Entity\Connection $connection
     * @return UpdateQueue
     */
    public function setConnection(\AppBundle\Entity\Connection $connection = null)
    {
        $this->connection = $connection;

        return $this;
    }

    /**
     * Get connection
     *
     * @return \AppBundle\Entity\Connection 
     */
    public function getConnection()
    {
        return $this->connection;
    }
}
