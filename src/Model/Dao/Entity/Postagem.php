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
    private $usuario;
    private $assunto;

    public function __construct(int $id = null, string $tipo, string $link, string $titulo,
        string $descricao = null, int $votos = 0, string $dataCriacao = null, Usuario $usuario, Assunto $assunto)
    {
        $this->$id = $id;
        $this->$tipo = $tipo;
        $this->$link = $link;
        $this->$titulo = $titulo;
        $this->descricao = $descricao;
        $this->$votos = $votos;
        $this->$dataCriacao = $dataCriacao;
        $this->$usuario = $usuario;
        $this->$assunto = $assunto;
    }

    protected function createData(): void
    {
        $this->data = array('id' => $this->id, 'tipo' => $this->tipo, 'link' => $this->link,
            'titulo' => $this->titulo, 'descricao' => $this->descricao, 'votos' => $this->votos,
            'data_criacao' => $this->dataCriacao, 'usuario_id' => $this->usuario->getId(),
            'assunto_id' => $this->assunto->getId());
    }

}
     