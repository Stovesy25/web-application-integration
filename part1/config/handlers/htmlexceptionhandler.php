<?php

/**
 * HTMLexceptionHandler
 * 
 * This function sets the HTML headers and outputs an error in HTML.
 * 
 * @author Graham Stoves, w19025672
 */

function HTMLexceptionHandler($e)
{
    echo "<p>Internal server error! (Status 500)</p>";
    if (DEVELOPMENT_MODE) {
        echo "<p>";
        echo "Message: " . $e->getMessage();
        echo "<br>File: " . $e->getFile();
        echo "<br>Line: " . $e->getLine();
        echo "</p>";
    }
}