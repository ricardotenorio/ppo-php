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

    public function createPostagemPage($data): void 
    {
        echo $this->template->render("createPostagem", [
            "title" => "Criar Postagem",
            "data" => $data,
            "router" => $this->router
        ]);
    }

    public function createPostagemAction($data): void
    {
        $data["link"] = Postagem::checkUrlProtocol($data["link"]);
        if (!checkLink($data["link"])) {
            $this->createPostagemPage(array("error" => "Url inválida!"));
        } else {
            $postagemModel = new PostagemModel();
            $usuario = unserialize($_SESSION["usuario"]);
            
            $postagemModel->createPostagem($data["tipo"], $data["link"], $data["titulo"], $data["descricao"],
                $usuario, $data["assunto"]);
        } 
    }

    public function checkLink(string $link): bool
    {
        if (Postagem::validLinkUrl($link)) {
            return true;
        }

        return false;
    }
}
  