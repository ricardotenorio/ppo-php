<?php
declare(strict_types = 1);

namespace Ppo\Controller;

use League\Plates\Engine;
use Ppo\Model\UsuarioModel;
use Ppo\Model\PermissaoModel;

class Signup
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
        echo $this->template->render("signup", [
            "title" => "Cadastro",
            "data" => $data,
            "router" => $this->router
        ]);
    }

    public function signupAction($data): void
    {
        $usuarioModel = new UsuarioModel();
        $permissaoModel = new PermissaoModel();
        $permissao = $permissaoModel->getPermissao("usuario");

        $usuario = $usuarioModel->registerUsuario($data["nome"], $data["email"], $data["senha"], $permissao);

        if (isset($usuario)) {
            session_start();
            $_SESSION["usuario"] = serialize($usuario);
            $_SESSION["username"] = $usuario->getNome();
            $_SESSION["user_id"] = $usuario->getId();

            echo $this->template->render("home", [
                "title" => "Home",
                "router" => $this->router
            ]);
        } else {
            // exibir erros depois...
            $this->page(array("error" => "Ocorreu algum erro"));
        }
        
    }
}
  