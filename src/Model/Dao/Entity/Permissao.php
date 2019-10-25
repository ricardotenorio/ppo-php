<?php
declare(strict_types = 1);

namespace Ppo\Model\Entity;

class Permissao extends AbstractEntity
{
    private $id;
    private $nome;

    public function __construct(int $id = null, string $nome)
    {
        $this->$id = $id;
        $this->$nome = $nome;
    }

    protected function createData(): void
    {
        $this->data = array('id' => $this->id, 'nome' => $this->nome);
    }

}
     