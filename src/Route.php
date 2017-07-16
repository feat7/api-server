<?php

namespace Feat7\ApiServer;

/**
* Routes
*/

class Route
{
	/**
	* @var $routes
	* @type array
	*/
	public static $routes;

	public static function getFinalRoute()
	{
		$route = self::$routes[self::getRequestMethod()][self::getUri()];

		if(is_callable($route)) {
			return $route(); //Closure
		} else if(is_array($route)) {
			$explode = explode('@', $route['uses']);	
		} else {
			$explode = explode('@', $route);
		}

		$controller = $explode[0];
		$method = $explode[1];

		$controllerName = '\\App\Controllers\\'.$controller;

		$obj = new $controllerName();

		if(is_callable([$obj, $method])) 
			call_user_func([$obj, $method]);

		else var_dump("$controller@$method Not found! Check your routes");

		return;

	}


	public static function getRequestMethod()
	{
		if($_SERVER['REQUEST_METHOD']=='POST') {
			if(isset($_POST['_method'])) {
				return self::clean($_POST['_method']);
			} 

			return self::clean($_SERVER['REQUEST_METHOD']);
		} 
		
		return self::clean($_SERVER['REQUEST_METHOD']);
	}

	public static function get($path, $route)
	{
		self::addRoute('GET', $path, $route);
	}

	public static function post($path, $route)
	{
		self::addRoute('POST', $path, $route);
	}

	public static function put($path, $route)
	{
		self::addRoute('PUT', $path, $route);
	}

	public static function patch($path, $route)
	{
		self::addRoute('PATCH', $path, $route);
	}

	public static function delete($path, $route)
	{
		self::addRoute('DELETE', $path, $route);
	}
	
	public static function addRoute($method = 'GET', $path = 'error/path', $route = 'ErrorHandler@pathError')
	{
		self::$routes[strtoupper($method)][$path] = $route;
	
	}
	public static function getRoutes()
	{
		return self::$routes;
	}

	public static function clean($string)
	{
		return htmlspecialchars(stripslashes(trim($string)));
	}

	public static function getUri()
	{
		return (substr($_SERVER['REQUEST_URI'], strlen(PATH))) ? substr($_SERVER['REQUEST_URI'], strlen(PATH)) : '/';
	}
}