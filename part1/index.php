<?php

/**
 * Handles the different requests
 * 
 * When a request is made in the URL, it is passed to
 * one of these controllers. It passes errors in the API requests
 * to the APIErrorController 
 * 
 * @author Graham Stoves, w19025672
 */

include "config/config.php";

$request = new Request();

if (substr($request->getPath(), 0, 3) === "api") {
    $response = new JSONResponse();
    $controller = new ApiErrorController($request, $response);
} else {
    set_exception_handler("HTMLexceptionHandler");
    $response = new HTMLResponse();
    $controller = new ErrorController($request, $response);
}

switch ($request->getPath()) {
    case '':
        $controller = new ErrorController($request, $response);
    case 'part1':
        $controller = new HomeController($request, $response);
        break;
    case 'documentation':
        $controller = new DocumentationController($request, $response);
        break;
    case 'api':
        $controller = new ApiBaseController($request, $response);
        break;
    case 'api/authors':
        $controller = new ApiAuthorsController($request, $response);
        break;
    case 'api/papers':
        $controller = new ApiPapersController($request, $response);
        break;
    case 'api/authenticate':
        $controller = new ApiAuthenticateController($request, $response);
        break;
    case 'api/readinglist':
        $controller = new ApiReadingListController($request, $response);
        break;
    default:
        break;
}

echo $response->getData();