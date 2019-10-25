<?php
declare(strict_types = 1);

namespace Ppo\Model\Entity;

class Assunto extends AbstractEntity
{
    private $id;
    private $nome;
    private $descricao;
    private $dataCriacao;
    private $votos;
    private $usuarioId;

    public function __construct(int $id = null, string $nome, string $descricao,
        string $dataCriacao = null, int $votos = 0, int $usuarioId)
    {
        $this->$id = $id;
        $this->$nome = $nome;
        $this->descricao = $descricao;
        $this->$dataCriacao = $dataCriacao;
        $this->$votos = $votos;
        $this->$usuarioId = $usuarioId;
    }

    protected function createData(): void
    {
        $this->data = array('id' => $this->id, 'nome' => $this->nome, 'descricao' => $this->descricao,
            'data_criacao' => $this->dataCriacao, 'votos' => $this->votos, 'usuario_id' => $this->usuarioId);
    }

}
     