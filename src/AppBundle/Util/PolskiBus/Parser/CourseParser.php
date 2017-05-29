<?php

namespace AppBundle\Util\PolskiBus\Parser;

use PHPHtmlParser\Dom;
use AppBundle\Util\PolskiBus\Data\CourseData;

class CourseParser extends ParserAbstract
{
    public function parse($response)
    {
        $courseDataArray = [];
        // 1. Select html with courses, to accelerate further process
        $courses = $this->selectCourses($response);
        foreach ($courses as $course) {
            $courseDataArray[] = $this->createCourseData($course);
        }

        return $courseDataArray;
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
        $courseData = new CourseData();

        $courseData->setDepartureDate($this->findDepartureDate($course));
        $courseData->setArrivalDate($this->findArrivalDate($course));
        $courseData->setPrice($this->findPrice($course));

        return $courseData;
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
        $dateHtml = $course->find('.onb_two')->find('p')[1]->find('b')->text();
        preg_match('/([0-9][0-9: -.]+[0-9])/', $dateHtml, $matches);
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
}