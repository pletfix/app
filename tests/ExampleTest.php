<?php

use Core\Testing\MinkTestCase;

class ExampleTest extends MinkTestCase
{
    /**
     * A basic functional test example.
     */
    public function testBasicExample()
    {
        $this->assertEquals(1, 1);
    }


// todo:  travis-ci schlägt plötzlich fehl, liegt aber nicht am Source!
// funktionierte am 27. Okt.: PHPUnit 5.7.23, PHP 7.1.11 with Xdebug 2.5.5
// aber nicht mehr am 12 Dez: PHPUnit 5.7.25, PHP 7.1.12 with Xdebug 2.5.5
//
//    /**
//     * A mink test example.
//     */
//    public function testMinkExample()
//    {
//        $url = config('app.url');
//        $this->session->visit($url);
//        $page = $this->session->getPage();
//
//        $title = $page->find('xpath', '//title');
//        if ($title !== null) {
//            $title = $title->getText();
//        }
//
//        $this->assertEquals('Pletfix Application', $title);
//    }
}