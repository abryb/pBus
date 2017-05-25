<?php
/**
 * Created by PhpStorm.
 * User: bazej
 * Date: 25.05.17
 * Time: 22:01
 */

namespace AppBundle\Util;
use PHPHtmlParser\Dom;

class ResponseParser
{
    /**
     * @var Dom
     */
    private $dom;

    public function __construct()
    {
        $this->dom = new Dom;
    }

    public function parse()
    {
    }


}