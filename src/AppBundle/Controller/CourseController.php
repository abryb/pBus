<?php

namespace AppBundle\Controller;

use AppBundle\Util\PolskiBus\Parser\StationParser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Util\PolskiBus\CourseUpdater;
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
     *
     * @Route("/s");
     */
    public function sAction()
    {
        $requestSender = new RequestSender();
        $respons = $requestSender->checkStations();

        $responseParser = new ResponseParser($respons);
        $parser = new StationParser();
        $result = $parser->parse($respons);

        return new Response(var_dump($result));
    }
}