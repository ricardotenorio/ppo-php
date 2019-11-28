<?php
declare(strict_types = 1);

namespace Ppo\Model\Entity;

class Permissao extends AbstractEntity
{
    private $id;
    private $nome;
    private $usuarios;

    public function __construct(int $id = null, string $nome, array $usuarios = null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->usuarios = $usuarios;
    }

    protected function createData(): void
    {
        $this->data = array('id' => $this->id, 'nome' => $this->nome);
    }

    public function addUsuario(Usuario $usuario): bool
    {
        return $this->addToArray($usuario, $this->usuarios);
    }

    public function removeUsuario(Usuario $usuario): bool
    {
        return $this->removeFromArray($usuario, $this->usuarios);
    }

    // getters & setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getUsuarios(): ?array
    {
        return $this->usuarios;
    }

    public function setUsuarios(array $usuarios): void
    {
        $this->usuarios = $usuarios;
    }

}
     