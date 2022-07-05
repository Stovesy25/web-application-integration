<?php

/**
 * Generate a webpage
 * 
 * This class will construct a HTML5 webpage, using the components 
 * from webpagecomponents.php, including a head, body and foot.
 * 
 * @author Graham Stoves, w19025672
 */

abstract class Webpage
{
    private $head;
    private $foot;
    private $body;

    protected function setHead($title)
    {
        $this->head = webpageComponents::webpageHead($title);
    }

    private function getHead()
    {
        return $this->head;
    }

    protected function addMainHeading($text)
    {
        $this->setBody("<h1>$text</h1>");
    }

    protected function addSubHeading($subHeading)
    {
        $this->setBody("<h2>$subHeading</h2>");
    }

    protected function setBody($text)
    {
        $this->body .= $text;
    }

    private function getBody()
    {
        return $this->body;
    }

    protected function setFoot()
    {
        $this->foot = webpageComponents::webpageFoot();
    }

    private function getFoot()
    {
        return $this->foot;
    }

    protected function addMenu($links)
    {
        $menu = webpageComponents::menu($links);
        $this->setBody($menu);
    }

    public function generateWebpage()
    {
        return $this->head . $this->body . $this->foot;
    }
}