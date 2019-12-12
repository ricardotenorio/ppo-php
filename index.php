<?php 
	require __DIR__ . "/vendor/autoload.php";

	use Ppo\Controller\Test;
	use CoffeeCode\Router\Router;

	define("BASE", "http://localhost/ppo-php");
	$router = new Router(BASE);

	$router->group("");
	$router->get("/", function() 
		{
			echo "<h1> home <h1>";
		}
	);

	$router->group("test")->namespace("Ppo\Controller");

	$router->get("/", "Test:home");
	$router->get("/hello", "Test:hello", "test.hello");

	$router->dispatch();

	//echo "<pre>", var_dump($router), "<pre>";

	if ($router->error()) {
		var_dump($router->error());
	}
