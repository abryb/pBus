<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Util\PBRequest;
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
        $pbrequest = new PBRequest();
        return new Response(var_dump($pbrequest));
    }

}