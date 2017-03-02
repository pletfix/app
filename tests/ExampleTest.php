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

    /**
     * A mink test example.
     */
    public function testMinkExample()
    {
        $url = config('app.url');
        $this->session->visit($url);
        $page = $this->session->getPage();

        $title = $page->find('xpath', '//title');
        if ($title !== null) {
            $title = $title->getText();
        }

        $this->assertEquals($title, 'Pletfix Application');
    }
}