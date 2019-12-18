<?php
declare(strict_types = 1);

namespace Ppo\Model;

use Ppo\Model\Entity\Lista;
use Ppo\Model\Entity\Usuario;
use Ppo\Model\Repository\ListaRepository;

class ListaModel
{
    private $repository;

    public function __construct()
    {
        $this->repository = new ListaRepository;
    }

    public function createLista(string $nome, string $descricao = null,
        string $dataCriacao = null, Usuario $usuario): ?Lista
    {
        $lista = new Lista(null, $nome, $descricao, date("Y-m-d"), 0, $usuario, null);
        $id = $this->repository->save($lista);

        if (isset($id)) {
            $lista->setId($id);
            return $lista;
        }

        return null;
    }

    public function updateLista(Lista $lista): void
    {
        $this->repository->save($lista);
    }

    public function deleteLista(Lista $lista): void
    {
        $this->repository->delete($lista);
    }

    public function getLista(Usuario $usuario): ?Lista
    {
        if(!isset($usuario)) {
            return null;
        }
        $lista = $this->repository->searchByUsuario($usuario);

        return $lista;
    }

    public function getListas(): ?array
    {
        $listas = $this->repository->listAll();

        return $listas;
    }
}
  