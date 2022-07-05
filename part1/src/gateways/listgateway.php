<?php

/**
 * Papers Gateway class
 * 
 * This class is used to interact with the list table
 * 
 * @author Graham Stoves, w19025672
 */

class ListGateway extends Gateway
{
    /**Sets the database to the list database */
    public function __construct()
    {
        $this->setDatabase(USER_DATABASE);
    }

    /** 
     * findAll
     *
     * Finds all the papers
     *
     * @param string @id - holds the id of the user
     */
    public function findAll($id)
    {
        $sql = "SELECT DISTINCT paper_id FROM list WHERE id = :id";
        $params = [":id" => $id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }

    /** 
     * add
     *
     * Inserts a paper into the list
     *
     * @param string @id - holds the id of the user
     * @param string @paper_id - holds the id of the paper
     */
    public function add($id, $paper_id)
    {
        $sql = "INSERT into list (id, paper_id) VALUES (:id, :paper_id)";
        $params = [":id" => $id, ":paper_id" => $paper_id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
    }

    /** 
     * remove
     *
     * Removes a paper from the list
     *
     * @param string @id - holds the id of the user
     * @param string @paper_id - holds the id of the paper
     */
    public function remove($id, $paper_id)
    {
        $sql = "DELETE FROM list WHERE (id = :id) AND (paper_id = :paper_id)";
        $params = [":id" => $id, ":paper_id" => $paper_id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
    }
}