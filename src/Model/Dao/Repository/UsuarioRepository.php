<?php
    declare(strict_types = 1);

    namespace Ppo\Model\Repository;

    use Ppo\Model\Entity\Usuario;
    use Ppo\Model\Entity\AbstractEntity;

    class UsuarioRepository extends AbstractRepository
    {
        public function createObject(array $entity = null): ?AbstractEntity
        {
            if (!$entity) {
                return null;
            }
            $usuario;
            $postagens;

            if (!empty($entity["postagens"])){
                $postagens = $entity["postagens"];
            } else {
                $postagens = array();
            }

            $usuario = new Usuario($entity["id"], $entity["nome"], $postagens);

            return $usuario;
        }

        public function save(Usuario $usuario): void
        {
            if (empty($usuario->getId())) {
                $this->insert("usuario", $usuario->getData());
            } else {
                $this->update("usuario", $usuario->getData(), array("id" => $usuario->getId()));
            }
        }

        public function delete(Usuario $usuario): void
        {
            $this->deleteRow("usuario", array("id" => $usuario->getId()));
        }

        public function searchById(int $id): ?Usuario
        {
            $data = $this->fetch("usuario", null, array("id" => $id));
            
            $usuario = $this->createObject($data);

            return $usuario;
        }

        public function searchByNome(string $nome): ?Usuario
        {
            $data = $this->fetch("usuario", null, array("nome" => $nome));
            $usuario = $this->createObject($data);

            return $usuario;
        }

        public function listAll(): ?array
        {
            $data = $this->fetchAll("usuario");
            $usuarios = array();

            foreach ($data as $key => $value) {
                array_push($usuarios, $this->createObject($value));
            }

            return $usuarios;
        }
    }