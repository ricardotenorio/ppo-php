<?php
    declare(strict_types = 1);

    namespace Ppo\Model\Repository;

    use Ppo\Model\Database\DatabaseConnection;
    use Ppo\Model\Entity;
    use PDOException;

    abstract class AbstractRepository
    {
        use CreateQueryTrait;
        public function save(string $entityName, array $data): ?Exception
        {
            try {
                $connection = DatabaseConnection::getInstance();
                if (empty($connection)){
                    return DatabaseConnection::getError();
                }

                $stmt = $connection->prepare($this->insertQuery($entityName, $data));
                $stmt->execute($data);
            } catch (PDOException $e){
                return $e;
            }
        }

        public function delete(string $entityName, array $conditions)
        {
            try {
                $connection = DatabaseConnection::getInstance();
                if (empty($connection)){
                    return DatabaseConnection::getError();
                }

                $stmt = $connection->prepare($this->deleteQuery($entityName, $conditions));
                $stmt->execute($conditions);
            } catch (PDOException $e) {
                return $e;
            }
        }
    }