<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Util\PolskiBus\CourseUpdater;
use Symfony\Component\HttpFoundation\Response;

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

        $courseUpdater = new CourseUpdater();
        $result = $courseUpdater->updateConnection($departure, $destination);

        return new Response(var_dump($result[0]));
    }

}