<?php
declare(strict_types = 1);

namespace Ppo\Controller;

use League\Plates\Engine;
use Ppo\Model\Entity\Postagem;
use Ppo\Model\Entity\Lista;
use Ppo\Model\PostagemModel;
use Ppo\Model\DisciplinaModel;
use Ppo\Model\AssuntoModel;
use Ppo\Model\ListaModel;

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

    public function minhasPostagensPage($data): void
    {
        $postagemModel = new PostagemModel();
        if (isset($_SESSION["username"])) {
            $usuario = unserialize($_SESSION["usuario"]);
        } else {
            $this->router->redirect("login.page", array("error" => "Você precisa estar logado para visualizar essa página"));
        }
        $postagens = $postagemModel->getPostagensByUsuario($usuario);

        echo $this->template->render("minhasPostagens", [
            "title" => "Minhas Postagens",
            "postagens" => $postagens,
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

            $usuario = unserialize($_SESSION["usuario"]);
            $postagemModel = new PostagemModel();
            
            $postagemModel->createPostagem($data["tipo"], $data["link"], $data["titulo"], $data["descricao"],
                $usuario, $assunto);
        }

        $this->router->redirect("postagens.usuario");
    }

    public function editPostagemPage($data): void
    {
        $id = filter_var($data["postagem_id"], FILTER_VALIDATE_INT);
        $postagemModel = new PostagemModel();
        $postagem = $postagemModel->getPostagemById($id);

        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $postagem->getUsuario()->getId()) {
            $disciplinaModel = new DisciplinaModel();
            $disciplinas = $disciplinaModel->getDisciplinas();
    
            echo $this->template->render("editPostagem", [
                "title" => "Editar Postagem",
                "postagem" => $postagem,
                "disciplinas" => $disciplinas,
                "data" => $data,
                "router" => $this->router
            ]);
        } else {
            $this->router->redirect("postagens.usuario");
        }
    }

    public function editPostagemAction($data): void
    {
        $id = filter_var($data["postagem_id"], FILTER_VALIDATE_INT);
        $postagemModel = new PostagemModel();
        $postagem = $postagemModel->getPostagemById($id);

        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $postagem->getUsuario()->getId()) {
            $data["link"] = Postagem::checkUrlProtocol($data["link"]);

            if (!$this->checkLink($data["link"])) {
                $this->editPostagemPage(array("error" => "Url inválida!"));
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

                $postagemModel = new PostagemModel();
                $usuario = unserialize($_SESSION["usuario"]);
                
                $postagem->setTipo($data["tipo"]);
                $postagem->setLink($data["link"]);
                $postagem->setTitulo($data["titulo"]);
                $postagem->setDescricao($data["descricao"]);
                $postagem->setAssunto($assunto);

                $postagemModel->updatePostagem($postagem);
                $this->router->redirect("postagens.usuario");
            }
        } else {
            $this->router->redirect("postagens.usuario");
        }
    }

    public function deletePostagemAction($data): void
    {
        if (empty($data["id"])) {
            return;
        }
        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $usuario = unserialize($_SESSION["usuario"]);
        $postagemModel = new PostagemModel();
        $postagem = $postagemModel->getPostagemById($id);
        
        if (!isset($postagem)) {
            $callback["msg"] = "Não foi possível remover a postagem";
        }

        if ($usuario == $postagem->getUsuario()) {
            $postagemModel->deletePostagem($postagem);
            $callback["remove"] = true;
        }

        echo json_encode($callback);
    }

    public function addPostagemAction($data): void
    {
        if (empty($data["id"])) {
            return;
        }
        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $usuario = unserialize($_SESSION["usuario"]);
        
        $listaModel = new ListaModel();
        $lista = $listaModel->getFavoritos($usuario);

        $postagemModel = new PostagemModel();
        $postagem = $postagemModel->getPostagemById($id);
        
        if (!isset($postagem)) {
            $callback["msg"] = "Não foi possível adicionar a postagem";
        }

        if ($lista->addPostagem($postagem)) {
            $listaModel->updateLista($lista);
            $callback["added"] = true;
        } else {
            $callback["added"] = false;
        }

        echo json_encode($callback);
    }

    public function checkLink(string $link): bool
    {
        if (Postagem::validLinkUrl($link)) {
            return true;
        }

        return false;
    }
}
  