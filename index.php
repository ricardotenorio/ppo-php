<?php 
	require __DIR__ . "/vendor/autoload.php";

	use Ppo\Controller\Test;
	use CoffeeCode\Router\Router;

	define("BASE", "http://localhost:8888");
	$router = new Router(BASE);

	$router->group("test")->namespace("Ppo\Controller\Test");

	$router->get("/", "Test:home");
	$router->get("/hello", "Test:hello", "test.hello");

	$router->dispatch();

	if ($router->error()) {
		var_dump($router->error());
	}
