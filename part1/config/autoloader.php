<?php

/**
 * autoloader
 * 
 * This autoloader looks in each subfolder and finds each file.
 * An error is thrown if the file does not exist or cannot be found.
 * 
 * @author Graham Stoves, w19025672
 */

function autoloader($className)
{
    $controllers = 'src/controllers/';
    $database = 'src/database/';
    $gateways = 'src/gateways/';
    $request = 'src/request/';
    $responses = 'src/responses/';
    $webpages = 'src/webpages/';
    $handlers = 'config/handlers/';
    $jwt = 'src/firebase/jwt/';
    $filename = strtolower($className) . ".php";

    if (is_readable($controllers . $filename)) {
        include_once $controllers . $filename;
    } elseif (is_readable($database . $filename)) {
        include_once $database . $filename;
    } elseif (is_readable($gateways . $filename)) {
        include_once $gateways . $filename;
    } elseif (is_readable($request . $filename)) {
        include_once $request . $filename;
    } elseif (is_readable($responses . $filename)) {
        include_once $responses . $filename;
    } elseif (is_readable($webpages . $filename)) {
        include_once $webpages . $filename;
    } elseif (is_readable($handlers . $filename)) {
        include_once $handlers . $filename;
    } elseif (is_readable($jwt . $filename)) {
        include_once $jwt . $filename;
    } else {
        throw new exception("File not found: " . $className . " (" . $filename . ")");
    }
}