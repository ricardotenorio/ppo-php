<?php
    declare(strict_types = 1);

    namespace Ppo\Model\Repository;

    use Ppo\Model\Entity\Permissao;
    use Ppo\Model\Entity\AbstractEntity;

    class PermissaoRepository extends AbstractRepository
    {
        public function createObject(array $entity = null): ?AbstractEntity
        {
            if (!$entity) {
                return null;
            }
            $permissao;
            $usuarios;

            if (!empty($entity["usuarios"])){
                $usuarios = $entity["usuarios"];
            } else {
                $usuarios = array();
            }

            $permissao = new Permissao($entity["id"], $entity["nome"], $usuarios);

            return $permissao;
        }

        public function save(Permissao $permissao): void
        {
            if (empty($permissao->getId())) {
                $this->insert("permissao", $permissao->getData());
            } else {
                $this->update("permissao", $permissao->getData(), array("id" => $permissao->getId()));
            }
        }

        public function delete(Permissao $permissao): void
        {
            $this->deleteRow("permissao", array("id" => $permissao->getId()));
        }

        public function searchById(int $id): ?Permissao
        {
            $data = $this->fetch("permissao", null, array("id" => $id));
            
            $permissao = $this->createObject($data);

            return $permissao;
        }

        public function searchByNome(string $nome): ?Permissao
        {
            $data = $this->fetch("permissao", null, array("nome" => $nome));
            $permissao = $this->createObject($data);

            return $permissao;
        }

        public function listAll(): ?array
        {
            $data = $this->fetchAll("permissao");
            $permissoes = array();

            foreach ($data as $key => $value) {
                array_push($permissoes, $this->createObject($value));
            }

            return $permissoes;
        }
    }