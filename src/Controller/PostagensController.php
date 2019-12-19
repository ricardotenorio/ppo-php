<?php
declare(strict_types = 1);

namespace Ppo\Controller;

use League\Plates\Engine;
use Ppo\Model\PostagemModel;
use Ppo\Model\PermissaoModel;

class PostagensController
{
    private $router;
    private $template;

    public function __construct($router)
    {
        $this->router = $router;
        $this->template = Engine::create(__DIR__ . "/../../web", "php");
    }

    public function page($data): void
    {
        $postagemModel = new PostagemModel();
        $postagens = $postagemModel->getPostagens();

        echo $this->template->render("postagens", [
            "title" => "Postagens",
            "postagens" => $postagens,
            "data" => $data,
            "router" => $this->router
        ]);
    }
}
  