<?php
declare(strict_types = 1);

namespace Ppo\Model;

use Ppo\Model\Entity\Disciplina;
use Ppo\Model\Repository\DisciplinaRepository;

class DisciplinaModel
{
    private $repository;

    public function __construct()
    {
        $this->repository = new DisciplinaRepository();
    }

    public function createDisciplina(string $nome): void
    {
        if (!isset($nome) || $this->repository->searchByNome($nome)) {
            return;
        }

        $disciplina = new Disciplina(null, $nome, null);
        $this->repository->save($disciplina);
    }

    public function updateDisciplina(Disciplina $disciplina): void
    {
        $this->repository->save($disciplina);
    }

    public function deleteDisciplina(Disciplina $disciplina): void
    {
        $this->repository->delete($disciplina);
    }

    public function getDisciplinaByNome(string $nome): ?Disciplina
    {
        if(!isset($nome)) {
            return null;
        }
        $disciplina = $this->repository->searchByNome($nome);

        return $disciplina;
    }

    public function getDisciplinas(): ?array
    {
        $disciplinas = $this->repository->listAll();

        return $disciplinas;
    }
}
  