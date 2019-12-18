<?php
declare(strict_types = 1);

namespace Ppo\Controller;

use League\Plates\Engine;

class Login
{
    private $router;
    private $template;

    public function __construct($router)
    {
        $this->router = $router;
        $this->template = Engine::create(__DIR__ . "/../../web", "php");
    }
    
    public function page(): void
    {
        echo $this->template->render("login", [
            "title" => "Login",
            "router" => $this->router
        ]);
    }
}
  