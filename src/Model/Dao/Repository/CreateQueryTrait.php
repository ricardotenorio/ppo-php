<?php
    declare(strict_types = 1);

    namespace Ppo\Model\Repository;

    trait CreateQueryTrait
    {
        // $entityName = nome da tabela do db.
        // $data = array associativo contendo os nomes dos dados e valores.
        protected function insertQuery(string $entityName, array $data): string
        {
            $count = 0;
            $query = "INSERT INTO {$entityName} (";
            $queryAppend = " VALUES (";
            
            foreach ($data as $key => $value) {
                if ($key == 'id'){
                    $count++;
                    continue;
                }
                $query = $query . $key;
                $queryAppend = $queryAppend . ":{$key}";
                $count++;
                
                if ($count <= sizeof($data) - 1) {
                    $query = $query . ", ";
                    $queryAppend = $queryAppend . ", ";
                } else {
                    $query = $query . ")";
                    $queryAppend = $queryAppend . ")";
                }
            }

            $query = $query . $queryAppend;

            return $query;
        }

        // $entityName = nome da tabela do db.
        // $conditions = condições da cláusula WHERE.
        protected function deleteQuery(string $entityName, array $conditions): string
        {
            $count = 0;
            $query = "DELETE FROM {$entityName}" . $this->createWhereConditions($conditions);

            return $query;
        }

        // $entityName = nome da tabela do db.
        // $data = array associativo contendo os nomes dos dados e valores.
        protected function updateQuery(string $entityName, array $data, array $conditions ): string
        {
            $count = 0;
            $query = "UPDATE {$entityName} SET";

            foreach ($data as $key => $value) {
                $query = $query . " {$key} = :{$key}";
                $count++;

                if ($count <= sizeof($data) - 1) {
                    $query = $query . ",";
                }
            }

            $query = $query . $this->createWhereConditions($conditions);

            return $query;
        }

        // $entityName = nome da tabela do db.
        // $joinTables = array associativo contendo o nome de uma tabela como chave e
        //               um array com dois elementos com as condições do JOIN.
        // $conditions = condições da cláusula WHERE.
        protected function selectQuery(string $entityName, array $joinTables = null, array $conditions = null): string
        {
            $query = "SELECT {$entityName}.* FROM {$entityName}";

            if (!empty($joinTables)) {
                foreach ($joinTables as $key => $value) {
                    $query = $query . " JOIN {$key} ON {$value[0]} = {$value[1]}";

                }
            }

            $query = $query . $this->createWhereConditions($conditions);

            return $query;
        }

        private function createWhereConditions(array $conditions = null): string
        {
            if (empty($conditions)) {
                return "";
            }
            $count = 0;
            $query = " WHERE ";
            
            foreach ($conditions as $key => $value) { 
                $query = $query . $key . " = :" . $key;
                $count++;
                
                if ($count <= sizeof($conditions) - 1) {
                    $query = $query . " AND ";
                }
            }

            return $query;
        }
    }