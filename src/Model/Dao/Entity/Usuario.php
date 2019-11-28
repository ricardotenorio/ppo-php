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
    private $permissao;
    private $postagens;
    private $listas;

    public function __construct(int $id = null, string $nome, string $email,
        string $senha, string $dataCriacao = null, Permissao $permissao,
        array $postagens = null, array $listas = null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->dataCriacao = $dataCriacao;
        $this->permissao = $permissao;
        $this->postagens = $postagens;
        $this->listas = $listas;
    }

    protected function createData(): void
    {
        $this->data = array('id' => $this->id, 'nome' => $this->nome, 'email' => $this->email,
            'senha' => $this->senha, 'data_criacao' => $this->dataCriacao, 'permissao_id' => $this->permissao->getId());
    }

    public function addPostagem(Postagem $postagem): bool
    {
        return $this->addToArray($postagem, $this->postagens);
    }

    public function removePostagem(Postagem $postagem): bool
    {
        return $this->removeFromArray($postagem, $this->postagens);
    }

    public function addLista(Lista $lista): bool
    {
        return $this->addToArray($lista, $this->listas);
    }

    public function removeLista(Lista $lista): bool
    {
        return $this->removeFromArray($lista, $this->listas);
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

    public function getEmail(): string
    {
        return $this->discipina;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function setSenha(string $senha): void
    {
        $this->senha = $senha;
    }

    public function getDataCriacao(): string
    {
        return $this->dataCriaca;
    }

    public function setDataCriacao(string $dataCriacao): void
    {
        $this->dataCriacao = $dataCriacao;
    }

    public function getPermissao(): ?Permissao
    {
        return $this->permissao;
    }

    public function setPermissao(Permissao $permissao): void
    {
        $this->permissao = $permissao;
    }

    public function getPostagens(): ?array
    {
        return $this->postagens;
    }

    public function setPostagens(array $postagens): void
    {
        $this->postagens = $postagens;
    }

    public function getListas(): ?array
    {
        return $this->listas;
    }

    public function setListas(array $listas): void
    {
        $this->listas = $listas;
    }

}
     