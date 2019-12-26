<?php
declare(strict_types = 1);

namespace Ppo\Controller;

use League\Plates\Engine;
use Ppo\Model\Entity\Postagem;
use Ppo\Model\ListaModel;
use Ppo\Model\PermissaoModel;
use Ppo\Model\DisciplinaModel;
use Ppo\Model\AssuntoModel;

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
            "descricao" => $lista->getDescricao(),
            "postagens" => $lista->getPostagens(),
            "data" => $data,
            "router" => $this->router
        ]);
    }

}
  