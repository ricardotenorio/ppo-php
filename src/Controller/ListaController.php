<?php
declare(strict_types = 1);

namespace Ppo\Controller;

use League\Plates\Engine;
use Ppo\Model\Entity\Postagem;
use Ppo\Model\Entity\Lista;
use Ppo\Model\Entity\Usuario;
use Ppo\Model\ListaModel;
use Ppo\Model\PostagemModel;

class ListaController
{
    private $router;
    private $template;

    public function __construct($router)
    {
        $this->router = $router;
        $this->template = Engine::create(__DIR__ . "/../../web", "php");
    }

    public function favoritosPage($data): void
    {
        $usuario = unserialize($_SESSION["usuario"]);

        $listaModel = new ListaModel();
        $lista = $listaModel->getFavoritos($usuario);

        if (!isset($lista)) {
            $this->router->redirect("web.home");
        }

        echo $this->template->render("favoritos", [
            "title" => "Favoritos",
            "lista" => $lista,
            "descricao" => $lista->getDescricao(),
            "postagens" => $lista->getPostagens(),
            "data" => $data,
            "router" => $this->router
        ]);
    }

    public function removePostagemAction($data): void
    {
        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $usuario = unserialize($_SESSION["usuario"]);
        
        $listaModel = new ListaModel();
        $lista = $listaModel->getFavoritos($usuario);

        $postagemModel = new PostagemModel();
        $postagem = $postagemModel->getPostagemById($id);

        if (!isset($lista)) {
            $callback["msg"] = "erro";
        } else {
            $lista->removePostagem($postagem);
            $listaModel->updateLista($lista);
            $callback["remove"] = true;
        }
        
        echo json_encode($callback);
    }

}
  