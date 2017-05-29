<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Util\PolskiBus\CourseUpdater;

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

        $date = new \DateTime();
        $date->modify('+20 days');

        $courseUpdater = new CourseUpdater();
        $result = $courseUpdater->update($departure, $destination, $date);
        foreach ($result as $course) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($course);
//            $em->flush();
        }

        return new Response(var_dump($result));
    }
}