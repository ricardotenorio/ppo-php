<?php
declare(strict_types = 1);

namespace Ppo\Model\Entity;

class Postagem extends AbstractEntity
{
    private $id;
    private $tipo;
    private $link;
    private $titulo;
    private $descricao;
    private $votos;
    private $dataCriacao;
    private $usuarioId;
    private $assuntoId;

    public function __construct(int $id = null, string $tipo, string $link, string $titulo,
        string $descricao = null, int $votos = 0, string $dataCriacao = null, int $usuarioId, int $assuntoId)
    {
        $this->$id = $id;
        $this->$tipo = $tipo;
        $this->$link = $link;
        $this->$titulo = $titulo;
        $this->descricao = $descricao;
        $this->$votos = $votos;
        $this->$dataCriacao = $dataCriacao;
        $this->$usuarioId = $usuarioId;
        $this->$assuntoId = $assuntoId;
    }

    protected function createData(): void
    {
        $this->data = array('id' => $this->id, 'tipo' => $this->tipo, 'link' => $this->link,
            'titulo' => $this->titulo, 'descricao' => $this->descricao, 'votos' => $this->votos,
            'data_criacao' => $this->dataCriacao, 'usuario_id' => $this->usuarioId, 'assunto_id' => $this->assuntoId);
    }

}
     