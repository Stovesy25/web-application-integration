<?php

/**
 * User Gateway class
 * 
 * This class is used to interact with the user table
 * 
 * @author Graham Stoves, w19025672
 */

class UserGateway extends Gateway
{

    /**Sets the database to the user database */
    public function __construct()
    {
        $this->setDatabase(USER_DATABASE);
    }

    /**
     * findPassword
     *    
     * This function queries the user database and selects the ID and password
     * where the email is the same as the email in the login form
     * 
     * @param string $email - holds the users email 
     */
    public function findPassword($email)
    {
        $sql = " SELECT id, password FROM user WHERE email = :email";
        $params = [":email" => $email];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }
}