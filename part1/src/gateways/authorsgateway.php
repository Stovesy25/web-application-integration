<?php

/**
 * Authors Gateway class
 * 
 * This class is used to interact with the authors table
 * 
 * @param string $sql - holds the SQL statement to be called in other functions
 * 
 * @author Graham Stoves, w19025672
 */

class AuthorsGateway extends Gateway
{
    /**Sets the database to the authors database */
    public function __construct()
    {
        $this->setDatabase(DIS_DATABASE);
    }

    /** 
     * findAll
     *
     * Finds all the authors 
     */
    public function findAll()
    {
        $sql = "SELECT * FROM author GROUP BY first_name";
        $result = $this->getDatabase()->executeSQL($sql);
        $this->setResult($result);
    }

    /** 
     * findOne
     *
     * Finds one of the authors depending on what ID is set in URL
     *
     * @param int $id - holds the author ID
     */
    public function findOne($id)
    {
        $sql = "SELECT * FROM author WHERE author_id = :id";
        $params = ["id" => $id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }

    /** 
     * findPaperAuthors
     *
     * Finds all the authors associated with a certain paper
     *
     * @param int $paper_id - holds the paper ID
     */
    public function findPaperAuthors($paper_id)
    {
        $sql = "SELECT author.author_id, author.first_name, author.middle_name, author.last_name, paper.doi FROM author JOIN paper_author on (author.author_id = paper_author.author_id) JOIN paper on (paper.paper_id = paper_author.paper_id) WHERE paper.paper_id = :paperid";
        $params = ["paperid" => $paper_id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }
}