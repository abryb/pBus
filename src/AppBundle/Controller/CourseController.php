<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Util\PBRequest;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Course;
use AppBundle\Entity\Station;

class CourseController extends Controller
{
    /**
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/");
     */
    public function indexAction()
    {
        $destination = new Station();
        $departure = new Station();
        $pbrequest = new PBRequest();
        $pbrequest->setDeparture($departure);
        $pbrequest->setDestination($destination);
        return new Response(var_dump($pbrequest));
    }

}