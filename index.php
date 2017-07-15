<?php

/**
* @package Api Server
* @author Vinay Khobragade (feat7)
*/

namespace Feat7\ApiServer;

ini_set('display_errors', 'On');
error_reporting(E_ALL);


/**
* Implement Autoloader.
* Default Namespace: Feat7/ApiServer
* Default Working Folder: src
*/

include __DIR__.'/vendor/autoload.php';

$test = new Test();

var_dump($test);