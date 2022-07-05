<?php

/**
 * HTML Response class
 * 
 * This child class inherits from Response and focuses on the HTML data.
 * 
 * @author Graham Stoves, w19025672
 */

class HTMLResponse extends Response
{
    /**
     * Sets the headers and states content will be HTML format
     */
    protected function headers()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: text/html; charset=UTF-8");
    }
}