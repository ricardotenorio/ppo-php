<?php
declare(strict_types = 1);

namespace Ppo\Model\Entity;

class Permissao extends AbstractEntity
{
    private $id;
    private $nome;
    private $usuarios;

    public function __construct(int $id = null, string $nome, array $usuarios)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->usuarios = $usuarios;
    }

    protected function createData(): void
    {
        $this->data = array('id' => $this->id, 'nome' => $this->nome);
    }

    public function addUsuario(usuario $usuario): bool
    {
        return $this->addToArray($usuario, $this->usuarios);
    }

    public function removeUsuario(usuario $usuario): bool
    {
        return $this->removeFromArray($usuario, $this->usuarios);
    }

}
     