<?php
    declare(strict_types = 1);

    namespace Ppo\Model\Repository;

    use Ppo\Model\Entity\Disciplina;
    use Ppo\Model\Entity\AbstractEntity;

    class DisciplinaRepository extends AbstractRepository
    {
        public function createObject(array $entity = null): ?AbstractEntity
        {
            if (!$entity) {
                return null;
            }
            $disciplina;
            $assuntos;

            if (!empty($entity["assuntos"])){
                $assuntos = $entity["assuntos"];
            } else {
                $assuntos = array();
            }

            $disciplina = new Disciplina($entity["id"], $entity["nome"], $assuntos);

            return $disciplina;
        }

        public function save(Disciplina $disciplina): void
        {
            if (empty($disciplina->getId())) {
                $this->insert("disciplina", $disciplina->getData());
            } else {
                $this->update("disciplina", $disciplina->getData(), array("id" => $disciplina->getId()));
            }
        }

        public function delete(Disciplina $disciplina): void
        {
            $this->deleteRow("disciplina", array("id" => $disciplina->getId()));
        }

        public function searchById(int $id): ?Disciplina
        {
            $data = $this->fetch("disciplina", null, array("id" => $id));
            
            $disciplina = $this->createObject($data);

            return $disciplina;
        }

        public function searchByNome(string $nome): ?Disciplina
        {
            $data = $this->fetch("disciplina", null, array("nome" => $nome));
            $disciplina = $this->createObject($data);

            return $disciplina;
        }

        public function listAll(): ?array
        {
            $data = $this->fetchAll("disciplina");
            $disciplinas = array();

            foreach ($data as $key => $value) {
                array_push($disciplinas, $this->createObject($value));
            }

            return $disciplinas;
        }
    }
  