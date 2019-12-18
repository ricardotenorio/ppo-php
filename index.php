<?php 
	require __DIR__ . "/vendor/autoload.php";
	require __DIR__ . "/src/config.php";

	use Ppo\Controller\Test;
	use CoffeeCode\Router\Router;

	$router = new Router(ROOT);

	$router->namespace("Ppo\Controller");
	$router->group("");
	$router->get("/", function() 
		{
			echo "<h1> home <h1>";
		}, "web.home"
	);

	$router->group("login");
	$router->get("/", "Login:page", "login.page");
	$router->post("/", "Login:loginAction", "login.loginAction");

	$router->group("signup");
	$router->get("/", "Signup:page", "signup.page");
	$router->post("/", "Signup:signupAction", "signup.signupAction");

	$router->group("test");

	$router->get("/", "Test:home");
	$router->get("/hello", "Test:hello", "test.hello");

	$router->dispatch();

	if ($router->error()) {
		var_dump($router->error());
	}
