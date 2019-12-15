<?php
declare(strict_types = 1);

namespace Ppo\Model;

use Ppo\Model\Entity\Usuario;
use Ppo\Model\Repository\UsuarioRepository;

class UsuarioModel
{

    public function registerUsuario(string $nome, string $email, string $senha,
        string $dataCriacao = null, Permissao $permissao): ?Usuario
    {
        $repository = new UsuarioRepository();

        if ($repository->verifyNome($nome) || $repository->verifyEmail($email)) {
            return null;
        }

        $usuario = new Usuario(null, $nome, $email, $senha, date("Y-m-d"), $permissao);

        $id = $repository->save($usuario);

        if (isset($id)) {
            $usuario->setId($id);
            return $usuario;
        }

        return null;
    }

    public function updateUsuario(Usuario $usuario): void
    {
        $repository = new UsuarioRepository();
        $repository->save($usuario);
    }

    public function login(string $nome, string $senha): ?Usuario
    {
        $repository = new UsuarioRepository();
        $usuario = $repository->searchByLogin($nome, $senha);

        return $usuario;
    }
}
  