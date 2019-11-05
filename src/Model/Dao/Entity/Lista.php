<?php
declare(strict_types = 1);

namespace Ppo\Model\Entity;

class Lista extends AbstractEntity
{
    private $id;
    private $nome;
    private $descricao;
    private $dataCriacao;
    private $votos;
    private $usuario;
    private $postagens;

    public function __construct(int $id = null, string $nome, string $descricao,
        string $dataCriacao = null, int $votos = 0, Usuario $usuario, array $postagens)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->dataCriacao = $dataCriacao;
        $this->votos = $votos;
        $this->usuario = $usuario;
        $this->postagens = $postagens;
    }

    protected function createData(): void
    {
        $this->data = array('id' => $this->id, 'nome' => $this->nome, 'descricao' => $this->descricao,
            'data_criacao' => $this->dataCriacao, 'votos' => $this->votos,
            'usuario_id' => $this->usuario->getId());
    }

    public function addPostagem(Postagem $postagem): bool
    {
        return $this->addToArray($postagem, $this->postagens);
    }

    public function removePostagem(Postagem $postagem): bool
    {
        return $this->removeFromArray($postagem, $this->postagens);
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

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function getDataCriacao(): string
    {
        return $this->dataCriacao;
    }

    public function setDataCriacao(string $dataCriacao): void
    {
        $this->dataCriacao = dataCriacao;
    }

    public function getVotos(): ?int
    {
        return $this->votos;
    }

    public function setVotos(int $votos): void
    {
        $this->votos = $votos;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(Usuario $usuario): void
    {
        $this->usuario = $usuario;
    }

    public function getPostagens(): ?array
    {
        return $this->postagens;
    }

    public function setPostagens(array $postagens): void
    {
        $this->postagens = $postagens;
    }
}
     