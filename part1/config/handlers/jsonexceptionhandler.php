<?php

/**
 * JSONexceptionHandler
 * 
 * This function sets the JSON headers and outputs an error in JSON.
 * 
 * @param string $output - holds the output data
 * 
 * @author Graham Stoves, w19025672
 */

function JSONexceptionHandler($e)
{
    header("Access-Control-Allow-Origin: *");
    header("Content-TypeL application/json; charset=UTF-8");

    $output['error'] = "Internal server error! (Status 500)";

    if (DEVELOPMENT_MODE) {
        $output['Message'] = $e->getMessage();
        $output['File'] = $e->getFile();
        $output['Line'] = $e->getLine();
    }
    echo json_encode($output);
}