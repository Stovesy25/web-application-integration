<?php

/**
 * ErrorController class
 * 
 * This class is used to set the content for the HTML error page.
 * 
 * @author Graham Stoves, w19025672
 */

class ErrorController extends Controller
{
    /**
     *processRequest 
     *
     * A new error page is created and the contents are passed into the error
     * page variable
     *
     * @param string $nav - holds the current URL to be passed to the href of
     * the nav link
     * @param string $page - holds the contents of the error page
     * @return string
     */

    protected function processRequest()
    {
        $nav = BASEPATH;
        $page = new ErrorPage(
            "Error",
            ["Home" => $nav .= "", "Documentation" => "documentation"],
            "This page does not exist.",
            "404 Error",
            "Click <a href= $nav .= \" \">here</a> to go back."
        );
        return $page->generateWebpage();
    }
}