<?php
    declare(strict_types = 1);

    namespace Ppo\Model\Repository;

    use Ppo\Model\Entity\Usuario;
    use Ppo\Model\Entity\AbstractEntity;
    use Ppo\Model\Repository\PermissaoRepository;

    class UsuarioRepository extends AbstractRepository
    {
        public function createObject(array $entity = null): ?AbstractEntity
        {
            if (!$entity) {
                return null;
            }
            $usuario;
            $permissao;
            $postagens;
            $listas;

            if (empty($entity["permissao"])){
                $permissaoRepository = new PermissaoRepository();
                $permissao = $permissaoRepository->searchById($entity["permissao_id"]);
            }

            if (!empty($entity["postagens"])){
                $postagens = $entity["postagens"];
            } else {
                $postagens = array();
            }

            if (!empty($entity["listas"])){
                $listas = $entity["listas"];
            } else {
                $listas = array();
            }

            $usuario = new Usuario($entity["id"], $entity["nome"], $entity["email"],
                $entity["senha"], $entity["data_criacao"], $permissao, $postagens, $listas);

            return $usuario;
        }

        public function save(Usuario $usuario): ?int
        {
            if (empty($usuario->getId())) {
                $id = $this->insert("usuario", $usuario->getData());
                return $id;
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

        public function searchByEmail(string $email): ?Usuario
        {
            $data = $this->fetch("usuario", null, array("email" => $email));
            $usuario = $this->createObject($data);

            return $usuario;
        }

        public function searchByPermissao(Permissao $permissao): ?array
        {
            $joinTables = array("permissao" => array("permissao_id", "permissao.id"));
            $conditions = array("permissao_id" => $permissao->getId());
            $data = $this->fetchAll("usuario", $joinTables, $conditions);
            $usuarios = array();

            foreach ($data as $key => $value) {
                array_push($usuarios, $this->createObject($value));
            }

            return $usuarios;
        }

        public function searchByLogin(string $nome, string $senha): ?Usuario
        {
            $data = $this->fetch("usuario", null, array("nome" => $nome, "senha" => $senha));
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

        public function verifyNome(string $nome): bool
        {
            $data = $this->fetch("usuario", null, array("nome" => $nome));

            if ($data) {
                return true;
            }

            return false;
        }

        public function verifyEmail(string $email): bool
        {
            $data = $this->fetch("usuario", null, array("email" => $email));

            if ($data) {
                return true;
            }

            return false;
        }
    }