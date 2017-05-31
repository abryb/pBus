<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Course;
use AppBundle\Entity\UpdateQueue;
use AppBundle\Entity\Connection;
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
        $connections = $em->getRepository('AppBundle:Connection')->findTracked();
        var_dump($connections);

        foreach ($connections as $connection) {
            $dates = new \DatePeriod(
                new \DateTime('now'),
                new \DateInterval('P1D'),
                $connection->getLastDate()
            );

            foreach ($dates as $date) {
                $updateQueue = new UpdateQueue();
                $updateQueue->setConnection($connection);
                $updateQueue->setDate($date);
                $em->persist($updateQueue);
            }
        }

        $em->flush();

        return new Response(var_dump($connections));
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