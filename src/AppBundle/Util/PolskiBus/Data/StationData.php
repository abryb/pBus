<?php

namespace AppBundle\Util\PolskiBus\Data;


class StationData
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $code;


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return StationData
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param int $code
     * @return StationData
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }
}