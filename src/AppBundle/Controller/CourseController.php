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
        $em = $this->getDoctrine()->getManager();

        $destination = $em->getRepository('AppBundle:Station')->findOneBy(['code' => 2]);
        $departure = $em->getRepository('AppBundle:Station')->findOneBy(['code' => 29]);

        $dates = [new \DateTime()];

        $pbrequest = new PBRequest($departure, $destination, $dates);
        $result = $pbrequest->send();

        return new Response(var_dump($result));
    }

}