<?php

/**
 * Controller class
 * 
 * This class is used to perform the actions in the request class, and then
 * populate the response class.
 * 
 * @param string $request - holds the request object passed from index.php
 * @param string $response - holds the response information passed from index.
 * php
 * @param string $gateway - used to interact with the database
 * 
 * @author Graham Stoves, w19025672
 */

abstract class Controller
{
    private $request;
    protected $reponse;
    protected $gateway;

    public function __construct($request, $response)
    {
        $this->setGateway();
        $this->setRequest($request);
        $this->setResponse($response);

        $data = $this->processRequest();
        $this->getResponse()->setData($data);
    }

    private function setRequest($request)
    {
        $this->request = $request;
    }

    protected function getRequest()
    {
        return $this->request;
    }

    private function setResponse($response)
    {
        $this->response = $response;
    }

    protected function getResponse()
    {
        return $this->response;
    }

    protected function setGateway()
    {
    }

    protected function getGateway()
    {
        return $this->gateway;
    }

    protected function processRequest()
    {
    }
}