<?php
declare(strict_types = 1);

namespace Ppo\Model;

use Ppo\Model\Entity\Permissao;
use Ppo\Model\Repository\PermissaoRepository;

class PermissaoModel
{
    public function getPermissao(string $nome): ?Permissao
    {
        $repository = new PermissaoRepository();
        $permissao = $repository->searchByNome($nome);

        return $permissao;
    }

}
  