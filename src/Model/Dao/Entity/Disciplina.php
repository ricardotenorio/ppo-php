<?php
declare(strict_types = 1);

namespace Ppo\Model\Entity;

class Disciplina extends AbstractEntity
{
    private $id;
    private $nome;
    private $assuntos;

    public function __construct(int $id = null, string $nome, array $assuntos)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->assuntos = $assuntos;
    }

    protected function createData(): void
    {
        $this->data = array('id' => $this->id, 'nome' => $this->nome);
    }

    public function addAssunto(Assunto $assunto): bool
    {
        return $this->addToArray($assunto, $this->assuntos);
    }

    public function removeAssunto(Assunto $assunto): bool
    {
        return $this->removeFromArray($assunto, $this->assuntos);
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

    public function getAssuntos(): ?array
    {
        return $this->assuntos;
    }

    public function setAssuntos(array $assuntos): void
    {
        $this->assuntos = $assuntos;
    }
}
     