<?php

/**
* @package Api Server
* @author Vinay Khobragade (feat7)
*/

namespace Feat7\ApiServer;

ini_set('display_errors', 'On');
error_reporting(E_ALL);

define('ABSPATH', __DIR__);

define('PATH', dirname($_SERVER['SCRIPT_NAME']));

/**
* Implement Autoloader.
*/

include __DIR__.'/vendor/autoload.php';

/**
* @args host, database name, user name, password
*/

$eloquent = new EloquentBridge('localhost', 'apiserver', 'apiserver', '123456');

//Connect and Boot Eloquent

$eloquent->connect();

$app = new Kernel();
