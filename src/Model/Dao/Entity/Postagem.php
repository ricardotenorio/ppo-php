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
        string $descricao = null, int $votos = 0, string $dataCriacao = null,
        Usuario $usuario = null, Assunto $assunto)
    {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->link = $link;
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->votos = $votos;
        $this->dataCriacao = $dataCriacao;
        $this->usuario = $usuario;
        $this->assunto = $assunto;
    }

    protected function createData(): void
    {
        $usuarioId = $this->usuario ? $this->usuario->getId() : null;

        $this->data = array('id' => $this->id, 'tipo' => $this->tipo, 'link' => $this->link,
            'titulo' => $this->titulo, 'descricao' => $this->descricao, 'votos' => $this->votos,
            'data_criacao' => $this->dataCriacao, 'usuario_id' => $usuarioId,
            'assunto_id' => $this->assunto->getId());
    }

    // verifica o protocolo da url, adicionando se não houver
    public static function checkUrlProtocol(string $url): string
    {
        $urlParts = parse_url($url);

        if (!isset($urlParts["scheme"])) {
            $url = "https://$url";
        }

        return $url;
    }

    public static function validLinkUrl(string $url): bool
    {
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            return true;
        }

        return false;
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

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): void
    {
        $this->tipo = $tipo;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): void
    {
        $this->titulo = $titulo;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function getVotos(): ?int
    {
        return $this->votos;
    }

    public function setVotos(int $votos): void
    {
        $this->votos = $votos;
    }

    public function getDataCriacao(): string
    {
        return $this->dataCriacao;
    }

    public function setDataCriacao(string $dataCriacao): void
    {
        $this->dataCriacao = $dataCriacao;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(Usuario $usuario): void
    {
        $this->usuario = $usuario;
    }

    public function getAssunto(): ?Assunto
    {
        return $this->assunto;
    }

    public function setAssunto(Assunto $assunto): void
    {
        $this->assunto = $assunto;
    }

}
     