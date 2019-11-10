<?php
    declare(strict_types = 1);

    namespace Ppo\Model\Repository;

    use Ppo\Model\Entity\Postagem;
    use Ppo\Model\Entity\AbstractEntity;
    use Ppo\Model\Repository\UsuarioRepository;
    use Ppo\Model\Repository\AssuntoRepository;

    class PostagemRepository extends AbstractRepository
    {
        public function createObject(array $entity = null): ?AbstractEntity
        {
            if (!$entity) {
                return null;
            }
            $postagem;
            $usuario;
            $assunto;

            if (empty($entity["usuario"])){
                $usuarioRepository = new UsuarioRepository();
                $usuario = $usuarioRepository->searchById($entity["usuario_id"]);
            } else {
                $usuario = $entity["usuario"];
            }

            if (empty($entity["assunto"])) {
                $assuntoRepository = new AssuntoRepository();
                $assunto = $assuntoRepository->searchById($entity["assunto_id"]);
            } else {
                $assunto = $entity["assunto"];
            }

            $postagem = new Postagem($entity["id"], $entity["tipo"], $entity["link"],
                $entity["titulo"], $entity["descricao"], 0, $entity["data_criacao"], $usuario, $assunto);

            return $postagem;
        }

        public function save(Postagem $postagem): void
        {
            if (empty($postagem->getId())) {
                $postagem->setDataCriacao(date("Y-m-d H:i:s"));
                $this->insert("postagem", $postagem->getData());
            } else {
                $this->update("postagem", $postagem->getData(), array("id" => $postagem->getId()));
            }
        }

        public function delete(Postagem $postagem): void
        {
            $this->deleteRow("postagem", array("id" => $postagem->getId()));
        }

        public function searchById(int $id): ?Postagem
        {
            $data = $this->fetch("postagem", null, array("id" => $id));
            
            $postagem = $this->createObject($data);

            return $postagem;
        }

        public function searchByTitulo(string $titulo): ?Postagem
        {
            $data = $this->fetch("postagem", null, array("titulo" => $titulo));
            $postagem = $this->createObject($data);

            return $postagem;
        }

        public function searchByAssunto(Assunto $assunto): ?array
        {
            $joinTables = array("assunto" => array("assunto_id", "assunto.id"));
            $conditions = array("assunto_id" => $assunto->getId());
            $data = $this->fetchAll("postagem", $joinTables, $conditions);
            $postagens = array();

            foreach ($data as $key => $value) {
                array_push($postagens, $this->createObject($value));
            }

            return $postagens;
        }

        public function searchByUsuario(Usuario $usuario): ?array
        {
            $joinTables = array("usuario" => array("usuario_id", "usuario.id"));
            $conditions = array("usuario_id" => $usuario->getId());
            $data = $this->fetchAll("postagem", $joinTables, $conditions);
            $postagens = array();

            foreach ($data as $key => $value) {
                array_push($postagens, $this->createObject($value));
            }

            return $postagens;
        }

        public function listAll(): ?array
        {
            $data = $this->fetchAll("postagem");
            $postagens = array();

            foreach ($data as $key => $value) {
                array_push($postagens, $this->createObject($value));
            }

            return $postagens;
        }
    }