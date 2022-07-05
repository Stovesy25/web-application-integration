<?php

/**
 * Database class
 * 
 * This class is used to create a connection to the databases
 * 
 * @param string $dbConnection - holds the database connection
 * 
 * @author Graham Stoves, w19025672
 */

class Database
{
    private $dbConnection;

    public function __construct($dbName)
    {
        $this->setDbConnection($dbName);
    }

    /**
     * setDbConnection
     *
     * Sets the database connection by finding  
     * all the database files.
     *
     * @param string $dbname - the name of the database
     */
    private function setDbConnection($dbName)
    {
        $this->dbConnection = new PDO('sqlite:' . $dbName);
        $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function executeSQL($sql, $params = [])
    {
        $stmt = $this->dbConnection->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}