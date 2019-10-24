<?php
    declare(strict_types = 1);

    namespace Ppo\Model\Repository;

    trait CreateQueryTrait
    {
        protected function insertQuery(string $entityName, array $data): string
        {
            $count = 0;
            $query = "INSERT INTO {$entityName} (";
            $queryAppend = " VALUES (";
            
            foreach ($data as $key => $value) { 
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

        protected function deleteQuery(string $entityName, array $conditions): string
        {
            $count = 0;
            $query = "DELETE FROM {$entityName}" . createConditions($conditions);

            return $query;
        }

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

            $query = $query . createConditions($conditions);

            return $query;
        }

        private function createConditions(array $conditions): string
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