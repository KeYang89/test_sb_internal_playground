<?php

namespace SBWebApplication\Filter\Tests;

use SBWebApplication\Filter\SlugifyFilter;

class SlugifyTest extends \PHPUnit_Framework_TestCase
{
    public function testFilter()
    {
        $filter = new SlugifyFilter;

        $values = [
            'PAGEKIT'                  => 'sb_new_web',
            ":#*\"@+=;!><&.%()/'\\|[]" => "",
            "  a b ! c   "             => "a-b-c",
        ];

        foreach ($values as $in => $out) {
            $this->assertEquals($out, $filter->filter($in));
        }

    }
}
