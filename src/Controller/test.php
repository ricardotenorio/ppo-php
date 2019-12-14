<?php
declare(strict_types = 1);

namespace Ppo\Controller;

use League\Plates\Engine;
use Ppo\Model\Entity\Postagem;
use Ppo\Model\Repository\PostagemRepository;

class Test
{
    private $router;
    private $templates;

    public function __construct($router)
    {
        $this->router = $router;
        $this->templates = Engine::create(__DIR__ . "/../../web", "php");
    }

    public function home(): void
    {
        $postagemRep = new PostagemRepository();
        $postagens = $postagemRep->listAll();
        echo $this->templates->render("home", [
            "title" => "Home",
            "postagens" => $postagens,
            "router" => $this->router
        ]);
    }

    public function hello(): void
    {
        echo "<h1> Hello from Test <h1>";
    }
}
  