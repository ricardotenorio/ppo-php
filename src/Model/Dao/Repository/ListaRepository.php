<?php
    declare(strict_types = 1);

    namespace Ppo\Model\Repository;

    use Ppo\Model\Entity\Lista;
    use Ppo\Model\Entity\UsuarioRepository;
    use Ppo\Model\Entity\PostagemRepository;
    use Ppo\Model\Entity\AbstractEntity;

    class ListaRepository extends AbstractRepository
    {
        public function createObject(array $entity = null): ?AbstractEntity
        {
            if (!$entity) {
                return null;
            }
            $lista;
            $usuario;
            $postagens;

            if (empty($entity["usuario"])){
                $usuarioRepository = new UsuarioRepository();
                $usuario = $usuarioRepository->searchById($entity["usuario_id"]);
            } else {
                $usuario = $entity["usuario"];
            }

            if (empty($entity["postagens"])) {
                $postagens = $this->fetchConteudo($entity["id"]);
            } else {
                $postagens = $entity["postagens"];
            }

            $lista = new Lista($entity["id"], $entity["tipo"], $entity["link"],
                $entity["nome"], $entity["descricao"], 0, $entity["data_criacao"], $usuario, $postagens);

            return $lista;
        }

        public function save(Lista $lista): void
        {
            if (empty($lista->getId())) {
                $lista->setDataCriacao(date("Y-m-d"));
                $this->insert("lista", $lista->getData());
            } else {
                $this->update("lista", $lista->getData(), array("id" => $lista->getId()));
            }
            
            $conditions = array("lista_id" => $lista->getId());
            $data = $this->fetchAll("lista_conteudo", null, $conditions);

            foreach ($lista->getPostagens() as $i => $postagem) {
                $contains = false;
                foreach ($data as $j => $conteudo) {
                    if ($postagem->getId() == $conteudo["postagem_id"]) {
                        $contains = true;
                        break;
                    }
                }

                if (!$contains) {
                    $this->insert("lista_conteudo", array("lista_id" => $lista->getId(), 
                    "postagem_id" => $postagem->getId()));
                }
            }
        }

        public function delete(Lista $lista): void
        {
            $this->deleteRow("lista", array("id" => $lista->getId()));
            $this->deleteRow("lista_conteudo", array("lista_id" => $lista->getId));
        }

        public function searchById(int $id): ?Lista
        {
            $data = $this->fetch("lista", null, array("id" => $id));
            
            $lista = $this->createObject($data);

            return $lista;
        }

        public function searchByNome(string $nome): ?Lista
        {
            $data = $this->fetch("lista", null, array("nome" => $nome));
            $lista = $this->createObject($data);

            return $lista;
        }


        public function searchByUsuario(Usuario $usuario): ?array
        {
            $joinTables = array("usuario" => array("usuario_id", "usuario.id"));
            $conditions = array("usuario_id" => $usuario->getId());
            $data = $this->fetchAll("lista", $joinTables, $conditions);
            $listas = array();

            foreach ($data as $key => $value) {
                array_push($listas, $this->createObject($value));
            }

            return $listas;
        }

        private function fetchConteudo(int $listaId): ?array
        {
            $joinTables = array("postagem" => array("postagem.id", "postagem_id"));
            $conditions = array("lista_id" => $listaId);
            $data = $this->fetchAll("postagem", $joinTables, $conditions);
            $postagens = array();
            $postagemRepository = new PostagemRepository();

            foreach ($data as $key => $value) {
                array_push($postagens, $postagemRepository->createObject($value));
            }

            return $postagens;
        }

        public function listAll(): ?array
        {
            $data = $this->fetchAll("lista");
            $listas = array();

            foreach ($data as $key => $value) {
                array_push($listas, $this->createObject($value));
            }

            return $listas;
        }
    }