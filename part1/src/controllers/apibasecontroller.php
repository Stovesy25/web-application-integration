<?php

/**
 * ApiBaseController class
 * 
 * This class is used to display information when the user goes 
 * to /api endpoint
 * 
 * @author Graham Stoves, w19025672
 */

class ApiBaseController extends Controller
{
   protected function processRequest()
   {
      $this->getResponse()->setMessage("Ok");
      $this->getResponse()->setStatusCode(200);
      $data['student']['name'] = "Graham Stoves";
      $data['student']['id'] = "w19025672";
      $data['message'] = "This API displays the student's name, student ID and a link to the documentation page.";
      $data['documentation'] = "The API documentation can be found via this page: http://localhost/kf6012/coursework/part1/documentation";

      return $data;
   }
}