<?php

namespace AppBundle\Util;

use AppBundle\Util\PBRequest;
use AppBundle\Entity\Station;
use PHPHtmlParser\Dom;

class DBUpdater
{
    public function updateConnection(Station $departure, Station $destination)
    {
        $dates = new \DateTime();
        $dates->modify('+20 days');

        $pbrequest = new PBRequest($departure, $destination, $dates);

        $responses =  $pbrequest->send();
        $dom = new Dom;
        $onb_resultRows = [];
        foreach ($responses as $respons) {
            $dom->loadStr($respons, []);
            $onb_resultRows[] = $dom->find('.onb_resultRow');
        }
        return $onb_resultRows;
    }
}