<?php
declare(strict_types = 1);

namespace Ppo\Controller\Test;

class Test
{
    private $router;

    public function __construct($router)
    {
        $this->router = $router;
    }

    public function home(): void
    {
        echo "<p>home || test<p>";
        echo "<p>", $this->router->route("name.home"), "</p>";
        echo "<p>", $this->router->route("name.hello"), "</p>";
    }

    public function hello($data): void
    {
        echo "<h1> Hello from Test <h1>";
        var_dump($data);
    }
}