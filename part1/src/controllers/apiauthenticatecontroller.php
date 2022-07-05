<?php

/** 
 * ApiAuthenticateController class
 *
 * This class handles authenticating the user.
 *
 * @author Graham Stoves w19025672
 */

class ApiAuthenticateController extends Controller
{
    /** 
     * setGateway
     *
     * Used to set the gateway property in the Gateway class to find the 
     * right database
     */
    protected function setGateway()
    {
        $this->gateway = new UserGateway();
    }

    /** 
     * Provides a token for logged in user
     *
     * Email and password are passed through and checked whether they exist in 
     * the database. If the password is the same as the hashed password in the
     * database, a token is given to the user which allows them to remain logged 
     * in.
     *
     * @param array $data - array that holds all the information
     * @param string $email - the email the user types into the form
     * @param string $password - the password the user types into the form
     * @param string $hashpassword - the password in the database
     * @param string $key - holds the secret key which was generated in config.
     * php
     * @param array $payload - holds the id and the expiry time of the token
     * @param string $jwt - JWT class is called to encode the token
     * @param array $data - holds the encoded token 
     */
    protected function processRequest()
    {
        $data = [];

        $email = $this->getRequest()->getParameter("email");
        $password = $this->getRequest()->getParameter("password");

        if ($this->getRequest()->getRequestMethod() === "POST") {
            if (!is_null($email) && !is_null($password)) {
                $this->getGateway()->findPassword($email);
                if (count($this->getGateway()->getResult()) == 1) {
                    $hashpassword = $this->getGateway()->getResult()[0]['password'];
                    if (password_verify($password, $hashpassword)) {
                        $key = SECRET_KEY;
                        $payload = array(
                            "id" => $this->getGateway()->getResult()[0]['id'],
                            "exp" => time() + 7776000
                        );
                        $jwt = JWT::encode($payload, $key, 'HS256');
                        $data = ['token' => $jwt];
                    }
                    $this->getResponse()->setMessage("Ok");
                    $this->getResponse()->setStatusCode(200);
                }
            }

            if (!array_key_exists('token', $data)) {
                $this->getResponse()->setMessage("Unauthorised");
                $this->getResponse()->setStatusCode(401);
            }
        } else {
            $this->getResponse()->setMessage("Method not allowed");
            $this->getResponse()->setStatusCode(405);
        }
        return $data;
    }
}