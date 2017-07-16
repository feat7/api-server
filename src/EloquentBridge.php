<?php

namespace Feat7\ApiServer;

use \Illuminate\Database\Capsule\Manager as Capsule;
use \Illuminate\Events\Dispatcher;
use \Illuminate\Container\Container;

/**
* Uses capsule to make bridge with eloquent
*/
class EloquentBridge
{
	/**
	*
	*/

	function __construct($host = 'localhost', $database = 'apiserver', $username = 'root', $password = '')
	{
		$this->host = $host;
		$this->database = $database;
		$this->username = $username;
		$this->password = $password;
	}
	
	function connect()
	{
		$capsule = new Capsule;

		$capsule->addConnection([
		    'driver'    => 'mysql',
		    'host'      => $this->host,
		    'database'  => $this->database,
		    'username'  => $this->username,
		    'password'  => $this->password,
		    'charset'   => 'utf8',
		    'collation' => 'utf8_unicode_ci',
		    'prefix'    => '',
		]);

		// Set the event dispatcher used by Eloquent models... (optional)

		$capsule->setEventDispatcher(new Dispatcher(new Container));

		// Make this Capsule instance available globally via static methods... (optional)
		$capsule->setAsGlobal();

		// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
		$capsule->bootEloquent();
	}

}



