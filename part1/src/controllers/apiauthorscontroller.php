<?php

/**
 * ApiAuthorsController class
 * 
 * This class is used to check whether the different paramaters
 * are null, including id and paper_id. If they are not null the method will
 * be passed to the gateway and the SQL query will be run.
 * 
 * @author Graham Stoves, w19025672
 */

class ApiAuthorsController extends Controller
{
    /** 
     * setGateway
     *
     * Used to set the gateway property in the Gateway class to find the 
     * right database
     */
    protected function setGateway()
    {
        $this->gateway = new AuthorsGateway();
    }

    /**
     * processRequest
     *
     * Looks at what paramaters are in the request and invokes a relevant method
     * from the database gateway
     *
     * @param int $id - holds the author id
     * @param int $paper_id - holds paper id
     */

    protected function processRequest()
    {
        $id = $this->getRequest()->getParameter("id");
        $paper_id = $this->getRequest()->getParameter("paperid");

        if ($this->getRequest()->getRequestMethod() === "GET") {
            if (!is_null($id)) {
                $this->getGateway()->findOne($id);
            } elseif (!is_null($paper_id)) {
                $this->getGateway()->findPaperAuthors($paper_id);
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