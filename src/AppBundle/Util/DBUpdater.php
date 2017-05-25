<?php

namespace AppBundle\Util;

use AppBundle\Util\PBRequest;
use AppBundle\Entity\Station;

class DBUpdater
{
    public function updateConnection(Station $departure, Station $destination)
    {
        $dates = new \DateTime();
        $dates->modify('+20 days');
        $pbrequest = new PBRequest($departure, $destination, $dates);
        return $pbrequest->send();
    }
}