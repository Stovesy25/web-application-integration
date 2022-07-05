<?php

/**
 * ApiPapersController class
 * 
 * This class is used to check whether the different paramaters
 * are null, including paper_id, author_id, random and award. If they
 * are not null the method will be passed to the gateway and the SQL query
 * will be run.
 * 
 * @author Graham Stoves, w19025672
 */

class ApiPapersController extends Controller
{
    /** 
     * setGateway
     *
     * Used to set the gateway property in the Gateway class to find the 
     * right database
     */
    protected function setGateway()
    {
        $this->gateway = new PapersGateway();
    }

    /**
     * processRequest
     *
     * Looks at what paramaters are in the request and invokes a relevant method
     * from the database gateway
     *
     * @param int $id - holds the paper id
     * @param int $author_id - holds authors id
     * @param string $award - holds awards that the paper has won
     * @param int $random - holds one random paper
     */

    protected function processRequest()
    {
        $id = $this->getRequest()->getParameter("id");
        $author_id = $this->getRequest()->getParameter("authorid");
        $award = $this->getRequest()->getParameter("award");
        $random = $this->getRequest()->getParameter("random");

        if ($this->getRequest()->getRequestMethod() === "GET") {
            if (!is_null($id)) {
                $this->getGateway()->findOne($id);
            } elseif (!is_null($random)) {
                $this->getGateway()->findRandom();
            } elseif (!is_null($author_id)) {
                $this->getGateway()->findAuthor($author_id);
            } elseif (!is_null($award)) {
                $this->getGateway()->findAward($award);
            } else {
                $this->getGateway()->findAll();
            }
        } else {
            $this->getResponse()->setMessage("Method not allowed");
            $this->getResponse()->setStatusCode(405);
        }

        if (count($this->getGateway()->getResult()) > 0) {
            $this->getResponse()->setMessage("Ok");
            $this->getResponse()->setStatusCode(200);
        } elseif ($this->getRequest()->getRequestMethod() === "GET" && (count($this->getGateway()->getResult()) < 1)) {
            $this->getResponse()->setMessage("No content");
            $this->getResponse()->setStatusCode(404);
        }
        return $this->getGateway()->getResult();
    }
}