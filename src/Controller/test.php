<?php
declare(strict_types = 1);

namespace Ppo\Controller;

class Test
{
    private $router;

    public function __construct($router)
    {
        $this->router = $router;
        echo '<h1>TEST<h1> <br>';
    }

    public function home(): void
    {
        echo "<p>home || test<p>";
        echo "<p>", $this->router->route("name.home"), "</p>";
        echo "<p>", $this->router->route("name.hello"), "</p>";
    }

    public function hello(): void
    {
        echo "<h1> Hello from Test <h1>";
    }
}
  