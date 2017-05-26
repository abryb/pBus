<?php
/**
 * Created by PhpStorm.
 * User: bazej
 * Date: 25.05.17
 * Time: 22:01
 */

namespace AppBundle\Util\PolskiBus;

use PHPHtmlParser\Dom;
use AppBundle\Util\PolskiBus\CourseDataObtained;

class ResponseParser
{
    /**
     * @var Dom
     */
    private $dom;

    private $response;

    public function __construct($response = null)
    {
        $this->dom = new Dom;
        $this->response = $response;
    }

    public function parse()
    {
        $courseDataObtainedArray = [];
        // 1. Select html with courses, to accelerate further process
        $response = $this->response;
        $courses = $this->selectCourses($response);
        foreach ($courses as $course) {
            $courseDataObtainedArray[] = $this->createCourseData($course);
        }

        return $courseDataObtainedArray;

    }

    private function selectCourses($response)
    {
        $dom = $this->dom;
        $dom->load($response);
        $courses = $dom->find('#ResultsForm')->find('.onb_resultRow');
        return $courses;
    }

    private function createCourseData($course)
    {
        $dom = $this->dom;
        $course = $dom->load($course);

        $courseDataObtained = new CourseDataObtained();

        $courseDataObtained->setDepartureDate($this->findDepartureDate($course));
        $courseDataObtained->setArrivalDate($this->findArrivalDate($course));
        $courseDataObtained->setPrice($this->findPrice($course));

        return $courseDataObtained;
    }

    private function findDepartureDate(Dom $course)
    {
        $dateHtml = $course->find('.onb_two')->find('p')[0]->find('b')->text();
        preg_match('/([0-9][0-9: -.]+[0-9])/', $dateHtml, $matches);
        $dateString = $matches[0];
        $departureDate = \DateTime::createFromFormat('H:i - d.m.Y', $dateString);
        return $departureDate;
    }

    private function findArrivalDate(Dom $course)
    {
        $dateHtmlText = $course->find('.onb_two')->find('p')[1]->find('b')->text();
        preg_match('/([0-9][0-9: -.]+[0-9])/', $dateHtmlText, $matches);
        $dateString = $matches[0];
        $arrivalDate = \DateTime::createFromFormat('H:i - d.m.Y', $dateString);
        return $arrivalDate;
    }

    private function findPrice(Dom $course)
    {
        $priceString = $course->find('.priceHilite')->text();
        preg_match('/([0-9.]+)/', $priceString, $matches);
        $price = $matches[0];
        return $price;
    }

    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }
}