<?php
declare(strict_types = 1);

namespace Ppo\Model;

use Ppo\Model\Entity\Usuario;
use Ppo\Model\Entity\Lista;
use Ppo\Model\Repository\UsuarioRepository;

class UsuarioModel
{
    private $repository;

    public function __construct()
    {
        $this->repository = new UsuarioRepository();
    }

    public function registerUsuario(string $nome, string $email, string $senha,
        string $dataCriacao = null, Permissao $permissao): ?Usuario
    {
        if ($this->repository->verifyNome($nome) || $this->repository->verifyEmail($email)) {
            return null;
        }

        // ...Mudar depois...
        $senha = md5($senha);

        $usuario = new Usuario(null, $nome, $email, $senha, date("Y-m-d"), $permissao);

        $id = $this->repository->save($usuario);

        if (isset($id)) {
            $usuario->setId($id);
            $lista = new Lista("Favoritos", "Lista com suas postagens favoritas.", null, $usuario);
            $usuario->addLista($lista);
            return $usuario;
        }

        return null;
    }

    public function updateUsuario(Usuario $usuario): void
    {
        $this->repository->save($usuario);
    }

    public function login(string $nome, string $senha): ?Usuario
    {
        // .......
        $senha = md5($senha);
        $usuario = $this->repository->searchByLogin($nome, $senha);

        return $usuario;
    }
}
  