<?php

/**
 * HomeController class
 * 
 * This class is used to set the content for the homepage.
 * 
 * @author Graham Stoves, w19025672
 */

class HomeController extends Controller
{
    /**
     *processRequest 
     *
     * A new HomePage is created and the contents are passed into the homepage 
     * variable
     *
     * @param string $homePage - holds the contents of the homepage
     * @return string
     */
    protected function processRequest()
    {
        $homePage = new HomePage(
            "Home",
            ["Home" => "", "Documentation" => "documentation"],
            "Home",
            "Graham Stoves - w19025672",
            "This work is university coursework and is not associated with or endorsed by the DIS conference."
        );
        return $homePage->generateWebpage();
    }
}