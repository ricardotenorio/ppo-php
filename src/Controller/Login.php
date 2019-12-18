<?php
declare(strict_types = 1);

namespace Ppo\Controller;

use League\Plates\Engine;
use Ppo\Model\UsuarioModel;

class Login
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
        echo $this->template->render("login", [
            "title" => "Login",
            "data" => $data,
            "router" => $this->router
        ]);
    }

    public function loginAction($data): void
    {
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->login($data["nome"], $data["senha"]);

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
            $this->page(array("error" => "Nome de usuário/senha inválidos"));
        }
        
    }
}
  