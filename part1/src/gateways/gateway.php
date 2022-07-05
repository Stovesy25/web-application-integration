<?php

/**
 * Gateway class
 * 
 * This parent class allows connection between the controllers and the database 
 * 
 * @param string $database - allows new databases to be instantiated for
 * the gateways to use
 * @param string $result - sets the result that will be passed into the child
 * gateways
 * 
 * @author Graham Stoves, w19025672
 */

abstract class Gateway
{
    private $database;
    private $result;

    protected function setDatabase($database)
    {
        $this->database = new Database($database);
    }

    protected function getDatabase()
    {
        return $this->database;
    }

    protected function setResult($result)
    {
        $this->result = $result;
    }

    public function getResult()
    {
        return $this->result;
    }
}