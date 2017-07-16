<?php

namespace Feat7\ApiServer;

/**
* 
*/
class Kernel
{
	
	function __construct()
	{
		include ABSPATH.'/routes.php';

		Route::getFinalRoute();
	}

	function getUri()
	{
		return (substr($_SERVER['REQUEST_URI'], strlen(PATH))) ? substr($_SERVER['REQUEST_URI'], strlen(PATH)) : '/';
	}

	function getSegment($int = 0)
	{
		if(isset($_SERVER['REQUEST_URI'])) {
			return explode('/', trim($_SERVER['REQUEST_URI'], '/'))[$int];
		} else return null;
	}
}