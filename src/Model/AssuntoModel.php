<?php
declare(strict_types = 1);

namespace Ppo\Model;

use Ppo\Model\Entity\Assunto;
use Ppo\Model\Entity\Disciplina;
use Ppo\Model\Repository\AssuntoRepository;

class AssuntoModel
{
    private $repository;

    public function __construct()
    {
        $this->repository = new AssuntoRepository();
    }

    public function createAssunto(string $nome, Disciplina $disciplina): void
    {
        if (!isset($nome) || $this->repository->searchByNome($nome)) {
            return;
        }

        $assunto = new Assunto(null, $nome, $disciplina, null);
        $this->repository->save($assunto);
    }

    public function updateAssunto(Assunto $assunto): void
    {
        $this->repository->save($assunto);
    }

    public function deleteAssunto(Assunto $assunto): void
    {
        $this->repository->delete($assunto);
    }

    public function getAssuntoByNome(string $nome): ?Assunto
    {
        if(!isset($nome)) {
            return null;
        }
        $assunto = $this->repository->searchByNome($nome);

        return $assunto;
    }

    public function getAssuntoByDisciplina(Disciplina $disciplina): ?Assunto
    {
        if(!isset($disciplina)) {
            return null;
        }
        $assunto = $this->repository->searchByDisciplina($disciplina);

        return $assunto;
    }

    public function getassuntos(): ?array
    {
        $assuntos = $this->repository->listAll();

        return $assuntos;
    }
}
  