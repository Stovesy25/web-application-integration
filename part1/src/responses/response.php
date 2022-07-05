<?php

/**
 * Response class
 * 
 * This parent class is used to construct what is being sent to the client.
 * 
 * @param string $data - this holds the data that is being sent to the client
 * 
 * @author Graham Stoves, w19025672
 */

abstract class Response
{
    protected $data;

    public function __construct()
    {
        $this->headers();
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    protected function headers()
    {
    }
}