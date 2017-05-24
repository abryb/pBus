<?php

namespace AppBundle\Util;

use \Curl\MultiCurl;

class PBRequest
{
    private $multiCurl;

    public function __construct()
    {
        $this->MultiCurl = new MultiCurl();
    }
}