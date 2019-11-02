<?php
    declare(strict_types = 1);

    namespace Ppo\Model\Repository;

    use Ppo\Model\Entity\Disciplina;

    abstract class DisciplinaRepository extends AbstractRepository
    {
        private $listaDisciplinas;
        private $disciplina;

        public function createObject(array $entity): ?AbstractEntity
        {
            $assuntos;
            if ($entity["assuntos"]){
                $assuntos = $entity["assuntos"];
            } else {
                $assuntos = array();
            }
            $this->disciplina = new Disciplina($entity["id"], $entity["nome"], $assuntos);
        }
    }
  