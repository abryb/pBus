<?php

namespace AppBundle\Util\PolskiBus\Parser;

use PHPHtmlParser\Dom;
use AppBundle\Util\PolskiBus\Data\StationData;

class StationParser extends ParserAbstract
{
    public function parse($response)
    {
        $stationDataArray = [];
        // 1. Select html with stations, to accelerate further process
        $stations = $this->selectStations($response);
        foreach ($stations as $station) {
            $stationDataArray[] = $this->createStationData($station);
        }

        return $stationDataArray;
    }

    private function selectStations($response)
    {
        $dom = $this->dom;
        $dom->load($response);
        $stations = $dom->find('#PricingForm_FromCity')->find('option');
        return $stations;
    }

    private function createStationData(Dom\HtmlNode $station)
    {
        $stationData = new StationData();

        $stationData->setName($this->findName($station));
        $stationData->setCode($this->findCode($station));

        return $stationData;
    }

    private function findName(Dom\HtmlNode $station)
    {
        $name = $station->find('*')->text();
        return $name;
    }

    private function findCode(Dom\HtmlNode $station)
    {
        $code = $station->getAttribute('value');
        return $code;
    }
}