<?php

/**
 * ApiReadingListController class
 * 
 * This class is used to validate if a user is logged in and if they 
 * are, it checks to see whether they are adding or removing papers,
 * and sends the request to the gateway to run the SQL query.
 * 
 * @author Graham Stoves, w19025672
 */

class ApiReadingListController extends Controller
{

    /** 
     * setGateway
     *
     * Used to set the gateway property in the Gateway class to find the 
     * right database
     */
    protected function setGateway()
    {
        $this->gateway = new ListGateway();
    }

    /**
     * processRequest
     *
     * Looks at what paramaters are in the request and invokes a relevant method
     * from the database gateway
     *
     * @param string $token - holds the token given to the user when they log in
     * @param string $add - holds the add request to add papers to the reading 
     * list
     * @param string $remove - holds the remove request to remove papers
     * @param string $key - holds the secret key which was generated in config.
     * php
     * @param string $decoded - the token and key are passed to $decoded as 
     * parameters
     * @param int $id - the ID is accessed from the decoded token
     */
    protected function processRequest()
    {
        $token = $this->getRequest()->getParameter("token");
        $add = $this->getRequest()->getParameter("add");
        $remove = $this->getRequest()->getParameter("remove");

        if ($this->getRequest()->getRequestMethod() === "POST") {
            if (!is_null($token)) {
                $key = SECRET_KEY;
                $decoded = JWT::decode($token, new Key($key, 'HS256'));
                $id = $decoded->id;
                if (!is_null($add)) {
                    $this->getGateway()->add($id, $add);
                } elseif (!is_null($remove)) {
                    $this->getGateway()->remove($id, $remove);
                } else {
                    $this->getGateway()->findAll($id);
                }
                $this->getResponse()->setMessage("Ok");
                $this->getResponse()->setStatusCode(200);
            } else {
                $this->getResponse()->setMessage("Unauthorized");
                $this->getResponse()->setStatusCode(401);
            }
        } else {
            $this->getResponse()->setMessage("Method not allowed");
            $this->getResponse()->setStatusCode(405);
        }

        return $this->getGateway()->getResult();
    }
}