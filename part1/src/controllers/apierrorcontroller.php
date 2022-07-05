<?php

/**
 * ApiErrorController class
 * 
 * This class is used to display an API JSON error page if 
 * the user enters an invalid API endpoint
 * 
 * @author Graham Stoves, w19025672
 */

class ApiErrorController extends Controller
{
    protected function processRequest()
    {
        $this->getResponse()->setMessage("Endpoint not found");
        $this->getResponse()->setStatusCode(404);
        $data['documentation'] = "http://unn-w19025672.newnumyspace.co.uk/kf6012/coursework/documentation";

        return $data;
    }
}