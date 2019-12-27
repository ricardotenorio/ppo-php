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

class DisciplinaController
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
       
        if (isset($_GET["disciplina"])) {
            $auxArray = array();

            foreach ($postagens as $postagem) {
                if ($postagem->getAssunto()->getDisciplina()->getNome() == $_GET["disciplina"]) {
                    $auxArray[] = $postagem;
                }
            }
            $postagens = $auxArray;
        } 
        $disciplinaModel = new DisciplinaModel();
        $disciplinas = $disciplinaModel->getDisciplinas();

        echo $this->template->render("disciplina", [
            "title" => "Disciplinas",
            "disciplinas" => $disciplinas,
            "postagens" => $postagens,
            "data" => $data,
            "router" => $this->router
        ]);
    }
}
  