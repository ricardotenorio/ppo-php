<?php
declare(strict_types = 1);

namespace Ppo\Controller;

use League\Plates\Engine;
use Ppo\Model\Entity\Postagem;
use Ppo\Model\PostagemModel;
use Ppo\Model\PermissaoModel;
use Ppo\Model\DisciplinaModel;
use Ppo\Model\AssuntoModel;

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
        $disciplinaModel = new DisciplinaModel();
        $disciplinas = $disciplinaModel->getDisciplinas();

        echo $this->template->render("createPostagem", [
            "title" => "Criar Postagem",
            "disciplinas" => $disciplinas,
            "data" => $data,
            "router" => $this->router
        ]);
    }

    public function createPostagemAction($data): void
    {
        $data["link"] = Postagem::checkUrlProtocol($data["link"]);

        if (!$this->checkLink($data["link"])) {
            $this->createPostagemPage(array("error" => "Url inválida!"));
        } else {
            $assuntoNome = trim($data["assunto"]);
            $assuntoNome = ucfirst(strtolower($assuntoNome));
            $assuntoModel = new AssuntoModel();
            $assunto = $assuntoModel->getAssuntoByNome($assuntoNome);
            
            if (!isset($assunto)) {
                $disciplinaModel = new DisciplinaModel();
                $disciplina = $disciplinaModel->getDisciplinaByNome($data["disciplina"]);
                $assunto = $assuntoModel->createAssunto($assuntoNome, $disciplina);
            }

            session_start();
            $usuario = unserialize($_SESSION["usuario"]);
            $postagemModel = new PostagemModel();
            
            $postagemModel->createPostagem($data["tipo"], $data["link"], $data["titulo"], $data["descricao"],
                $usuario, $assunto);
        }

        $this->router->redirect("postagens.page");
    }

    public function checkLink(string $link): bool
    {
        if (Postagem::validLinkUrl($link)) {
            return true;
        }

        return false;
    }
}
  