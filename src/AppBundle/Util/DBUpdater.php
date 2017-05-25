<?php
/**
 * Created by PhpStorm.
 * User: bazej
 * Date: 25.05.17
 * Time: 08:44
 */

namespace AppBundle\Util;

use AppBundle\Util\PBRequest;
use AppBundle\Entity\Station;

class DBUpdater
{
    private $dates;

    public function updateConnection(Station $departure,Station $destination)
    {
        $pbrequest = new PBRequest($departure, $destination);
        $responses = $pbrequest->sendMultiple($this->dates);
    }
}