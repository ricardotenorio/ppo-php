<?php
declare(strict_types = 1);

namespace Ppo\Model;

use Ppo\Model\Entity\Postagem;
use Ppo\Model\Entity\Assunto;
use Ppo\Model\Entity\Usuario;
use Ppo\Model\Entity\Disciplina;
use Ppo\Model\Repository\PostagemRepository;
use Ppo\Model\Repository\DisciplinaRepository;

class PostagemModel
{
    private $repository;

    public function __construct()
    {
        $this->repository = new PostagemRepository();
    }

    public function createPostagem(string $tipo, string $link, string $titulo,
        string $descricao = null, Usuario $usuario, Assunto $assunto): void
    {
        $postagem = new Postagem(null, $tipo, $link, $titulo, $descricao, 0, date("Y-m-d H:i:s"),
            $usuario, $assunto);

        $this->repository->save($postagem);
    }

    public function updatePostagem(Postagem $postagem): void
    {
        $this->repository->save($postagem);
    }

    public function getPostagens(): ?array
    {
        $postagens = $this->repository->listAll();

        return $postagens;
    }

    public function getPostagensByUsuario(Usuario $usuario): ?array
    {
        if (!isset($usuario)) {
            return null;
        }
        $postagens = $this->repository->searchByUsuario($usuario);

        return $postagens;
    }

    public function getPostagemById(int $id): ?Postagem
    {
        if (!isset($id)) {
            return null;
        }

        $postagem = $this->repository->searchById($id);

        return $postagem;
    }

    public function getPostagensByAssunto(Assunto $assunto): ?array
    {
        if (!isset($assunto)) {
            return null;
        }
        $postagens = $this->repository->searchByAssunto($assunto);

        return $postagens;
    }

    public function deletePostagem(Postagem $postagem): void
    {
        if (!isset($postagem)) {
            return;
        }
        $postagens = $this->repository->delete($postagem);
    }
}
  