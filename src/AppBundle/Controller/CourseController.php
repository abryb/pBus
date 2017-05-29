<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Station;
use AppBundle\Util\PolskiBus\Parser\ConnectionParser;
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
        $requestSender = new RequestSender();
        $result = $requestSender->checkConnections();
        var_dump($result);

        $em = $this->getDoctrine()->getManager();
        $departure = $em->getRepository('AppBundle:Station')->findOneBy(['code' => 29]);
        $destination = $em->getRepository('AppBundle:Station')->findOneBy(['code' => 2]);

        $date = new \DateTime();
        $date->modify('+20 days');

        $result = $requestSender->checkCourses($departure, $destination, $date);
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
        $result = $responseParser->parse($response);

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
        $result = $responseParser->parse($response);

        return new Response(var_dump($result));
    }
}