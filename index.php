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
	$router->get("/", "LoginController:page", "login.page");
	$router->post("/", "LoginController:loginAction", "login.loginAction");
	$router->get("/logout", "LoginController:logoutAction", "login.logoutAction");

	$router->group("signup");
	$router->get("/", "SignupController:page", "signup.page");
	$router->post("/", "SignupController:signupAction", "signup.signupAction");

	$router->group("postagens");
	$router->get("/", "PostagensController:page", "postagens.page");
	$router->get("/create", "PostagensController:createPostagemPage", "postagens.create");
	$router->post("/create", "PostagensController:createPostagemAction", "postagens.createAction");

	$router->group("test");

	$router->get("/", "Test:home");
	$router->get("/hello", "Test:hello", "test.hello");

	$router->dispatch();

	if ($router->error()) {
		var_dump($router->error());
	}
