<?php

namespace AppBundle\Util;

use AppBundle\Util\PBRequest;
use AppBundle\Entity\Station;
use PHPHtmlParser\Dom;

class DBUpdater
{
    /**
     * @var Dom
     */
    private $dom;

    public function __construct()
    {
        $this->dom = new Dom;
    }

    public function updateConnection(Station $departure, Station $destination)
    {
        $dates = new \DateTime();
        $dates->modify('+20 days');

        $pbrequest = new PBRequest($departure, $destination, $dates);

        $responses =  $pbrequest->send();

        foreach ($responses as $response) {
            $this->parseResponse($response);
        }
    }

    private function splitResponseToCourses($response)
    {
        $dom = $this->dom;
        $dom->load($response);
        // Find form containing data
        $form = $dom->find('form');
        //Array of html with single course
        $htmlCourses = $form->find('.onb_resultRow');
        foreach ($htmlCourses as $htmlCourse) {
            $datesHtml = $htmlCourse->find('.onb_two');
            $departureDateString = $datesHtml->find('p')[0]->find('b')->text();
            $arrivalDateString = $datesHtml->find('p')[1]->find('b')->text();

            $durationHtml = $htmlCourse->find('.onb_three');
            $hoursString = $durationHtml->find('p')[0]->firstChild()->text();
            $minutesString = $durationHtml->find('p')[1]->firstChild()->text();

            $priceString = $htmlCourse->find('.priceHilite')->text();
        }
    }

    private function getDataFromCourses($htmlCourse)
    {
        $dom = $this->dom;
        $dom->load($htmlCourse);

        $datesHtml = $htmlCourse->find('.onb_two');
        $departureDateString = $datesHtml->find('p')[0]->find('b')->text();
        $arrivalDateString = $datesHtml->find('p')[1]->find('b')->text();

        $durationHtml = $htmlCourse->find('.onb_three');
        $hoursString = $durationHtml->find('p')[0]->firstChild()->text();
        $minutesString = $durationHtml->find('p')[1]->firstChild()->text();

        $priceString = $htmlCourse->find('.priceHilite')->text();
    }
}