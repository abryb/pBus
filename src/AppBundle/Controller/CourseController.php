<?php

namespace AppBundle\Controller;

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
        $repository = $this->getDoctrine()->getRepository('AppBundle:Connection');
        $connection = $repository->findOneBy(['departure' => 1574, 'destination' => 1571]);

        $polskiBus = new PolskiBus();
        $result = $polskiBus->getCourse($connection);

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