<?php

/**
 * JSON Response class
 * 
 * This child class inherits from Response and focuses on the JSON data from 
 * the API.
 * 
 * @param string $message - this holds a message to display to the user
 * @param int $statusCode - this holds the status code when a request is made
 * @param string $response - this holds all the response data which is then 
 * displayed to the user
 * 
 * @author Graham Stoves, w19025672
 */

class JSONResponse extends Response
{
    private $message;
    private $statusCode;

    /**
     * Sets the headers and states content will be json
     */
    protected function headers()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * getData
     * 
     * Checks whether there is data and puts it into an array and 
     * sets the status code. 
     * 
     * @return string $response - returns the message, status codes, how many
     * there was and what the results are
     */
    public function getData()
    {

        if (is_null($this->data)) {
            $this->data = [];
        }

        http_response_code($this->statusCode);

        $response['message'] = $this->message;
        $response['status'] = $this->statusCode;
        $response['count'] = count($this->data);
        $response['results'] = $this->data;
        return json_encode($response);
    }
}