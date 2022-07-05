<?php

/**
 * Documentation class
 * 
 * This class holds the elements to make the documentation page.
 * 
 * @param string $title - the page title 
 * @param string $links - the menu links
 * @param string $mainHeading - the main heading
 * @param string $subHeading - the sub heading
 * 
 * @author Graham Stoves, w19025672
 */

class DocumentationPage extends Webpage
{
    public function __construct($title, $links, $mainHeading, $subHeading)
    {
        $this->setHead($title);
        $this->addMenu($links);
        $this->addMainHeading($mainHeading);
        $this->addSubHeading($subHeading);
        $this->setFoot();
    }

    /**
     * apiDocumentation
     * 
     * Holds the elements to include in the documentation page to explain
     * each api endpoint
     * 
     * @param string $subHeading - sub heading 
     * @param string $link - hyperlink text
     * @param string $text - link text
     * @param string $methodsHeading - methods heading
     * @param string $methodsParagraph - methods paragraph
     * @param string $descriptionHeading - description heading
     * @param string $descriptionParagraph - description paragraph
     * @param string $parametersHeading - parameters heading
     * @param string $parametersParagraph - parameters paragraph
     * @param string $statusCodeHeading - status code heading
     * @param string $statusCodeParagraph - status code paragraph
     * @param string $requestHeading - request heading
     * @param string $requestParagraph - request paragraph
     * @param string $responseHeading - response heading
     * @param string $responseParagraph - response paragraph
     * 
     * @author Graham Stoves, w19025672
     */
    public function apiDocumentation($subHeading, $link, $text, $methodsHeading,  $methodsParagraph, $descriptionHeading, $descriptionParagraph, $parametersHeading, $parametersParagraph, $statusCodeHeading, $statusCodeParagraph, $requestHeading, $requestParagraph, $responseHeading, $responseParagraph)
    {
        $this->setBody("<div class='endpointContainer'>");
        $this->addSubHeading($subHeading);
        $this->setBody("<a class='link' href='$link'>$text</a><br>");
        $this->setBody("<h3>$methodsHeading</h3>");
        $this->setBody("<p>$methodsParagraph</p>");
        $this->setBody("<h3>$descriptionHeading</h3>");
        $this->setBody("<p>$descriptionParagraph</p>");
        $this->setBody("<h3>$parametersHeading</h3>");
        $this->setBody("<p>$parametersParagraph</p>");
        $this->setBody("<h3>$statusCodeHeading</h3>");
        $this->setBody("<p>$statusCodeParagraph</p>");
        $this->setBody("<h3>$requestHeading</h3>");
        $this->setBody("<p>$requestParagraph</p>");
        $this->setBody("<h3>$responseHeading</h3>");
        $this->setBody("<pre>$responseParagraph</pre>");
        $this->setBody("</div>");
    }
}