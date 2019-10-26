<?php
declare(strict_types = 1);

namespace Ppo\Model\Entity;

class Assunto extends AbstractEntity
{
    private $id;
    private $nome;
    private $disciplina;
    private $postagens;

    public function __construct(int $id = null, string $nome, Disciplina $disciplina, array $postagens)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->disciplina = $disciplina;
        $this->postagens = $postagens;
    }

    protected function createData(): void
    {
        $this->data = array('id' => $this->id, 'nome' => $this->nome,
            'disciplina_id' => $this->disciplina->getId());
    }

    public function addPostagem(Postagem $postagem): bool
    {
        return $this->addToArray($postagem, $this->postagens);
    }

    public function removePostagem(Postagem $postagem): bool
    {
        return $this->removeFromArray($postagem, $this->postagens);
    }

    //getters & setters

    public function getId(): int
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

    public function getDisciplina(): Disciplina
    {
        return $this->disciplina;
    }

    public function setDisciplina(Disciplina $disciplina): void
    {
        $this->disciplina = $disciplina;
    }
}
     