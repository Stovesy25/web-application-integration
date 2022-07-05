<?php

/**
 * Papers Gateway class
 * 
 * This class is used to interact with the papers table
 * 
 * @param string $sql - holds the SQL statement to be called in other functions
 * 
 * @author Graham Stoves, w19025672
 */

class PapersGateway extends Gateway
{
    private $sql = "SELECT paper.paper_id, paper.title, paper.abstract, award_type.name AS award_name, award.award_type_id, paper.doi FROM paper LEFT JOIN award on (award.paper_id = paper.paper_id) LEFT JOIN award_type on (award_type.award_type_id = award.award_type_id)";

    /**Sets the database to the paper database */
    public function __construct()
    {
        $this->setDatabase(DIS_DATABASE);
    }

    /** 
     * findAll
     *
     * Finds all the papers 
     */
    public function findAll()
    {
        $this->sql .= "GROUP BY paper.title";
        $result = $this->getDatabase()->executeSQL($this->sql);
        $this->setResult($result);
    }

    /** 
     * findOne
     *
     * Finds one of the papers depending on what ID is set in URL
     *
     * @param int $id - holds the paper ID
     */
    public function findOne($id)
    {
        $this->sql .= "WHERE paper.paper_id = :id";
        $params = ["id" => $id];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    /** 
     * findAuthor
     *
     * Finds all the papers connected to a certain author
     *
     * @param int $author_id - holds the authors ID 
     */
    public function findAuthor($author_id)
    {
        $this->sql .= "JOIN paper_author on (paper.paper_id = paper_author.paper_id) WHERE paper_author.author_id = :authorid";
        $params = ["authorid" => $author_id];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    /**
     * findRandom
     *
     * Finds one random paper
     *
     * @param string $pattern - holds a string value that is checked against
     * the URL
     *@param string $url - holds the current URL
     */
    public function findRandom()
    {
        $this->sql .= "order by random() limit 1";
        $pattern = '/\btrue\b/';
        $url = $_SERVER['REQUEST_URI'];
        if (preg_match($pattern, $url) == true) {
            $result = $this->getDatabase()->executeSQL($this->sql);
            $this->setResult($result);
        }
    }

    /**
     * findAward
     *
     * Finds papers based on what awards have been won
     *
     * @param string $pattern - holds a string value that is checked against
     * the URL
     *@param string $url - holds the current URL
     */
    public function findAward()
    {
        $this->sql .= "WHERE award_type.award_type_id IS NOT NULL";
        $pattern = '/\ball\b/';
        $url = $_SERVER['REQUEST_URI'];
        if (preg_match($pattern, $url) == true) {
            $result = $this->getDatabase()->executeSQL($this->sql);
            $this->setResult($result);
        }
    }
}