<?php

define('BASEPATH', '/kf6012/coursework/part1/');
define('DIS_DATABASE', 'database/dis.sqlite');
define('USER_DATABASE', 'database/user.sqlite');
define('DEVELOPMENT_MODE', true);
define('SECRET_KEY', 'd*WT8Xl}WmrQtHB');

ini_set('display_errors', DEVELOPMENT_MODE);
ini_set('display_startup_errors', DEVELOPMENT_MODE);

include 'config/autoloader.php';
spl_autoload_register("autoloader");

include 'config/handlers/htmlexceptionhandler.php';
include 'config/handlers/jsonexceptionhandler.php';
set_exception_handler("JSONexceptionHandler");

include 'config/handlers/errorhandler.php';
set_error_handler("errorHandler");