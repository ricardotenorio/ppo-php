<?php
declare(strict_types = 1);

namespace Ppo\Model\Entity;

class Usuario extends AbstractEntity
{
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $dataCriacao;
    private $permissaoId;

    public function __construct(int $id = null, string $nome, string $email,
        string $senha, string $dataCriacao = null, int $permissaoId)
    {
        $this->$id = $id;
        $this->$nome = $nome;
        $this->email = $email;
        $this->$senha = $senha;
        $this->$dataCriacao = $dataCriacao;
        $this->$permissaoId = $permissaoId;
    }

    protected function createData(): void
    {
        $this->data = array('id' => $this->id, 'nome' => $this->nome, 'email' => $this->email,
            'senha' => $this->senha, 'data_criacao' => $this->dataCriacao, 'permissao_id' => $this->permissaoId);
    }

}
     