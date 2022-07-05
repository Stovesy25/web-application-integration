<?php

/**
 * ErrorPage class
 * 
 * This class holds the elements to make the error page.
 * 
 * @param string $title - the page title 
 * @param string $links - the menu links
 * @param string $mainHeading - the main heading
 * @param string $subHeading - the sub heading
 * @param string $text - the paragraph text
 * 
 * @author Graham Stoves, w19025672
 */

class ErrorPage extends Webpage
{
   public function __construct($title, $links, $mainHeading, $subHeading, $text)
   {
      $this->setHead($title);
      $this->addMenu($links);
      $this->addMainHeading($mainHeading);
      $this->addSubHeading($subHeading);
      $this->addParagraph($text);
   }

   private function addParagraph($text)
   {
      $this->setBody("<p>$text</p>");
   }
}
