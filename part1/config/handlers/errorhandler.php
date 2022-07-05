<?php

/**
 * errorHandler
 * 
 * This function triggeres when an error or exception occurs.
 * 
 * @param int $errno - checks the error number
 * @param string $errstr - holds the error content
 * @param string $errfile - holds the file the error has occured in
 * @param string $errline - holds the line the error has occured on
 * 
 * @author Graham Stoves, w19025672
 */

function errorHandler($errno, $errstr, $errfile, $errline)
{
    if (($errno != 2 && $errno != 8) || DEVELOPMENT_MODE) {
        throw new Exception("Error Detected: [$errno] $errstr file: $errfile line: $errline", 1);
    }
}