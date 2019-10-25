<?php
declare(strict_types = 1);

namespace Ppo\Model\Entity;

class Assunto extends AbstractEntity
{
    private $id;
    private $nome;
    private $disciplinaId;

    public function __construct(int $id = null, string $nome, int $disciplinaId)
    {
        $this->$id = $id;
        $this->$nome = $nome;
        $this->disciplinaId = $disciplinaId;
    }

    protected function createData(): void
    {
        $this->data = array('id' => $this->id, 'nome' => $this->nome, 'disciplina_id' => $this->disciplinaId);
    }

}
     