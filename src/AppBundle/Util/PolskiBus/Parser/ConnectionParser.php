<?php

namespace AppBundle\Util\PolskiBus\Parser;

use PHPHtmlParser\Dom;
use AppBundle\Util\PolskiBus\Data\ConnectionData;

class ConnectionParser extends ParserAbstract
{
    public function parse($response)
    {
        // array to return
        $connectionsDataArray = [];
        // 1. Select json with connections
        $connectionsJson = $this->selectConnections($response);
        // 2. Decode json to array with StdClasses
        $connectionsStdClasses = json_decode($connectionsJson);
        // 3. Iterate array, to make our classes ConnectionData
        foreach ($connectionsStdClasses as $connectionsStdClass) {
            $connectionData = new ConnectionData();
            // StdClass property names are made by polskibus
            // Save code of city
            $connectionData->setDepartureCode($connectionsStdClass->FromCityID);
            $connectionData->setDestinationCode($connectionsStdClass->ToCityID);
            // Create DateTime from format
            $lastDate = \DateTime::createFromFormat('d/m/Y', $connectionsStdClass->LastDate);
            $connectionData->setLastDate($lastDate);
            // Put connectionData to array
            $connectionsDataArray[] = $connectionData;
        }

        return $connectionsDataArray;
    }

    private function selectConnections($response)
    {
        // Pattern is outcome of polskibus page
        preg_match('/var RouteLastDay =(\s*)(\'([^\']*)\')/', $response, $matches);
        return $matches[3];
    }
}