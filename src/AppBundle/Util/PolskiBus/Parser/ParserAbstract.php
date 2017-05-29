<?php
/**
 * Created by PhpStorm.
 * User: bazej
 * Date: 29.05.17
 * Time: 16:01
 */

namespace AppBundle\Util\PolskiBus\Parser;

use PHPHtmlParser\Dom;

abstract class ParserAbstract implements ParserInterface
{
    /**
     * @var Dom
     */
    protected $dom;

    public function __construct()
    {
        $this->dom = new Dom();
    }

    /**
     * @param string $a
     *
     */
    abstract function parse($a);
}