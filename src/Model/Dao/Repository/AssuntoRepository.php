<?php
    declare(strict_types = 1);

    namespace Ppo\Model\Repository;

    use Ppo\Model\Entity\Assunto;
    use Ppo\Model\Entity\Disciplina;
    use Ppo\Model\Entity\AbstractEntity;

    class AssuntoRepository extends AbstractRepository
    {
        public function createObject(array $entity = null): ?AbstractEntity
        {
            if (!$entity) {
                return null;
            }
            $assunto;
            $postagens;

            if (empty($entity["disciplina"])) {
                $disciplinaRepository = new DisciplinaRepository();
                $entity["disciplina"] = $disciplinaRepository->searchById($entity["disciplina_id"]);
            }

            if (!empty($entity["postagens"])) {
                $postagens = $entity["postagens"];
            } else {
                $postagens = array();
            }

            $assunto = new Assunto($entity["id"], $entity["nome"], $entity["disciplina"], $postagens);

            return $assunto;
        }

        public function save(Assunto $assunto): void
        {
            if (empty($assunto->getId())) {
                $this->insert("assunto", $assunto->getData());
            } else {
                $this->update("assunto", $assunto->getData(), array("id" => $assunto->getId()));
            }
        }

        public function delete(Assunto $assunto): void
        {
            $this->deleteRow("assunto", array("id" => $assunto->getId()));
        }

        public function searchById(int $id): ?Assunto
        {
            $data = $this->fetch("assunto", null, array("id" => $id));
            
            $assunto = $this->createObject($data);

            return $assunto;
        }

        public function searchByNome(string $nome): ?Assunto
        {
            $data = $this->fetch("assunto", null, array("nome" => $nome));
            $assunto = $this->createObject($data);

            return $assunto;
        }

        public function searchByDisciplina(Disciplina $disciplina): ?array
        {
            $joinTables = array("disciplina" => array("disciplina_id", "disciplina.id"));
            $conditions = array("disciplina_id" => $disciplina->getId());
            $data = $this->fetchAll("assunto", $joinTables, $conditions);
            $assuntos = array();

            foreach ($data as $key => $value) {
                array_push($assuntos, $this->createObject($value));
            }

            return $assuntos;
        }

        public function listAll(): ?array
        {
            $data = $this->fetchAll("assunto");
            $assuntos = array();

            foreach ($data as $key => $value) {
                array_push($assuntos, $this->createObject($value));
            }

            return $assuntos;
        }
    }
 