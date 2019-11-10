<?php
    declare(strict_types = 1);

    namespace Ppo\Model\Repository;

    use Ppo\Model\Entity\Lista;
    use Ppo\Model\Entity\AbstractEntity;
    use Ppo\Model\Repository\UsuarioRepository;
    use Ppo\Model\Repository\PostagemRepository;

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

            $lista = new Lista($entity["id"], $entity["nome"], $entity["descricao"],
                $entity["data_criacao"], 0, $usuario, $postagens);

            return $lista;
        }

        public function save(Lista $lista): void
        {
            if (empty($lista->getId())) {
                $id;
                $lista->setDataCriacao(date("Y-m-d H:i:s"));
                $id = $this->insert("lista", $lista->getData());
                $lista->setId($id);
            } else {
                $this->update("lista", $lista->getData(), array("id" => $lista->getId()));
            }

            $conditions = array("lista_id" => $lista->getId());
            $data = $this->fetchAll("lista_conteudo", null, $conditions);

            $this->deleteConteudo($lista, $data);
            $this->saveConteudo($lista, $data);
           
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

        public function listAll(): ?array
        {
            $data = $this->fetchAll("lista");
            $listas = array();

            foreach ($data as $key => $value) {
                array_push($listas, $this->createObject($value));
            }

            return $listas;
        }

        private function fetchConteudo(int $listaId): ?array
        {
            $joinTables = array("lista_conteudo" => array("postagem.id", "postagem_id"));
            $conditions = array("lista_id" => $listaId);
            $data = $this->fetchAll("postagem", $joinTables, $conditions);
            $postagens = array();
            $postagemRepository = new PostagemRepository();

            foreach ($data as $key => $value) {
                array_push($postagens, $postagemRepository->createObject($value));
            }

            return $postagens;
        }

        private function saveConteudo(Lista $lista, array $data): void
        {    
            foreach ($lista->getPostagens() as $i => $postagem) {
                $save = true;
                foreach ($data as $j => $conteudo) {
                    if ($postagem->getId() == $conteudo["postagem_id"]) {
                        $save = false;
                        break;
                    }
                }
                if ($save) {
                    $this->insert("lista_conteudo", array("lista_id" => $lista->getId(), 
                    "postagem_id" => $postagem->getId()));
                }
            }
        }

        private function deleteConteudo(Lista $lista, array $data): void
        {
            if (empty($data)){
                return;
            }
            if (empty($lista->getPostagens())) {
                $this->deleteRow("lista_conteudo", array("lista_id" => $lista->getId()));
            }

            foreach ($lista->getPostagens() as $i => $postagem) {
                $delete = true;
                foreach ($data as $j => $conteudo) {
                    if ($postagem->getId() == $conteudo["postagem_id"]) {
                        $delete = false;
                        break;
                    }
                }
                
                if ($delete) {
                    $this->deleteRow("lista_conteudo", array("lista_id" => $lista->getId(), 
                    "postagem_id" => $postagem->getId()));
                }
            }
        }
    }