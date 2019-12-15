<?php
declare(strict_types = 1);

namespace Ppo\Model;

use Ppo\Model\Entity\Postagem;
use Ppo\Model\Repository\PostagemRepository;

class PostagemModel
{
    public function registerPostagem(string $tipo, string $link, string $titulo,
        string $descricao = null, int $votos = 0, Usuario $usuario, Assunto $assunto): void
    {
        $repository = new PostagemRepository();

        $postagem = new Postagem(null, $tipo, $link, $titulo, $descricao, $votos, date("Y-m-d"),
            $usuario, $assunto);

        $repository->save($postagem);
    }

    public function updatePostagem(Postagem $postagem): void
    {
        $repository = new PostagemRepository();
        $repository->save($postagem);
    }

    public function getPostagens(): ?array
    {
        $repository = new PostagemRepository();
        $postagens = $repository->listAll();

        return $postagens;
    }

    public function getPostagensByUsuario(Usuario $usuario): ?array
    {
        if (!isset($usuario)) {
            return null;
        }
        $repository = new PostagemRepository();
        $postagens = $repository->searchByUsuario($usuario);

        return $postagens;
    }

    public function getPostagensByAssunto(Assunto $assunto): ?array
    {
        if (!isset($assunto)) {
            return null;
        }
        $repository = new PostagemRepository();
        $postagens = $repository->searchByAssunto($assunto);

        return $postagens;
    }

    public function removePostagem(Postagem $postagem): void
    {
        if (!isset($postagem)) {
            return;
        }
        $repository = new PostagemRepository();
        $postagens = $repository->delete($postagem);
    }
}
  