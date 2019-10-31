<?php
    declare(strict_types = 1);

    namespace Ppo\Model\Repository;

    use Ppo\Model\Database\DatabaseConnection;
    use Ppo\Model\Entity;
    use PDOException;

    abstract class AbstractRepository
    {
        use CreateQueryTrait;

        private $error;

        abstract public function createObject(array $entity): ?AbstractEntity;
       
        public function save(string $entityName, array $data): void
        {
            try {
                $connection = DatabaseConnection::getInstance();
                if (empty($connection)){
                    return;
                }

                $stmt = $connection->prepare($this->insertQuery($entityName, $data));
                $stmt->execute($data);
            } catch (PDOException $e){
                $this->error = $e;
            }
        }

        public function delete(string $entityName, array $conditions): void
        {
            try {
                $connection = DatabaseConnection::getInstance();
                if (empty($connection)){
                    return;
                }

                $stmt = $connection->prepare($this->deleteQuery($entityName, $conditions));
                $stmt->execute($conditions);
            } catch (PDOException $e) {
                $this->error = $e;
            }
        }

        public function update(string $entityName, array $data, array $conditions): void
        {
            try {
                $connection = DatabaseConnection::getInstance();
                if (empty($connection)){
                    return;
                }

                $stmt = $connection->prepare($this->updateQuery($entityName, $data, $conditions));
                $stmt->execute($data + $conditions);
            } catch (PDOException $e) {
                $this->error = $e;
            }
        }

        public function fetch(string $entityName, array $joinTables = null, array $conditions): ?array
        {
            $data;

            try {
                $connection = DatabaseConnection::getInstance();
                if (empty($connection)){
                    return DatabaseConnection::getError();
                }

                $stmt = $connection->prepare($this->selectQuery($entityName, $joinTables, $conditions));
                $stmt->execute($conditions);
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                $this->error = $e;
            }

            return $data;
        }

        public function getError(): ?Exception
        {
            return $this->error;
        }

    }
  