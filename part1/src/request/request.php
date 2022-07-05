<?php

/**
 * Request class
 * 
 * This class is used to handle requests to the API
 * 
 * @param string $basepath - this holds basepath of the folder structure
 * @param string $path - this holds the current URL path
 * @param string $requestMethod - this holds the request method, such as GET or 
 * POST
 * 
 * @author Graham Stoves, w19025672
 */

class Request
{
    private $basepath = BASEPATH;
    private $path;
    private $requestMethod;

    /**
     * Function that gets the current URL in lower case and uses a variable to
     * work out what request method has been made
     */
    public function __construct()
    {
        $this->path = parse_url($_SERVER["REQUEST_URI"])['path'];
        $this->path = strtolower(str_replace($this->basepath, "", $this->path));
        $this->path = trim($this->path, "/");
        $this->requestMethod = $_SERVER["REQUEST_METHOD"];
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    /** Access the INPUT_GET or INPUT_POST depending on what method has been used */
    public function getParameter($param)
    {
        if ($this->getRequestMethod() === "GET") {
            $param = filter_input(INPUT_GET, $param, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        if ($this->getRequestMethod() === "POST") {
            $param = filter_input(INPUT_POST, $param, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        return $param;
    }
}