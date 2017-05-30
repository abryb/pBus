<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Course;
use AppBundle\Util\PolskiBus\Parser\ConnectionParser;
use AppBundle\Util\PolskiBus\Parser\CourseParser;
use AppBundle\Util\PolskiBus\Parser\StationParser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Util\PolskiBus\PolskiBus;
use AppBundle\Util\PolskiBus\RequestSender;
use AppBundle\Util\PolskiBus\Parser\ResponseParser;

class CourseController extends Controller
{
    /**
     *
     * @Route("/");
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $connection = $em->getRepository('AppBundle:Connection')->findOneBy(['departure' => 29, 'destination' => 2]);

        $polskiBus = new PolskiBus();
        $result = $polskiBus->getCourses($connection);
        foreach ($result as $courseData) {
            $course = new Course();
            $course->setDestination($connection->getDestination());
            $course->setDeparture($connection->getDeparture());
            $course->setDepartureDate($courseData->getDepartureDate());
            $course->setArrivalDate($courseData->getArrivalDate());
            $course->setPrice($courseData->getPrice());
            $em->persist($course);
        }
        $em->flush();

        return new Response(var_dump($result));
    }

    /**
     * @Route("/c");
     */
    public function cAction()
    {
        $requestSender = new RequestSender();
        $response = $requestSender->checkConnections();

        $responseParser = new ResponseParser($response);
        $responseParser->setParser(new ConnectionParser());
        $result = $responseParser->parse();

        return new Response(var_dump($result));
    }

    /**
     * @Route("/s");
     */
    public function sAction()
    {
        $requestSender = new RequestSender();
        $response = $requestSender->checkStations();

        $responseParser = new ResponseParser($response);
        $responseParser->setParser(new StationParser());
        $result = $responseParser->parse();

        return new Response(var_dump($result));
    }
}