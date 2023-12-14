<?php
namespace Credentials;

class DataBase
{
    private $connection;

    public function __construct()
    {
        $this->connection = new Connection();
        // TODO: instancier PDO ici?
    }
    

    // insere un nouveau registre dans la table
    public function addRecord($table, $record)
    {
        try {
            $pdo = $this->connection->getConnection();

            $columns = implode(", ", array_keys($record));
            $vals = ":" . implode(", :", array_keys($record));
            $query = "INSERT INTO {$table} ({$columns}) VALUES ({$vals}) ";

            $stmt = $pdo->prepare($query);

            foreach ($record as $key => $value) {
                $stmt->bindValue(":{$key}", $value);
            }

            $stmt->execute();

            echo "Record created";
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // selectionne un registre dans la table
    public function selectRecord($table, $filter)
    {
        try {
            $pdo = $this->connection->getConnection();

            if (isset($filter['select_column'])) {
                $selected_column = $filter['select_column'];
                unset($filter['select_column']);
            } else {
                throw new \Exception("");
            }


            $query = "SELECT {$selected_column} FROM {$table} WHERE ";
            $conditions = [];
            foreach ($filter as $key => $val) {
                $conditions[] = "{$key} = :{$key}";
            }
            $query .= implode(' AND ', $conditions);
    
            $stmt = $pdo->prepare($query);
    
            foreach ($filter as $key => &$val) {
                $stmt->bindParam(":{$key}", $val);
            }

            $stmt->execute();

            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                // si '*' est selectionne, on itere sur toutes les colonnes
                if ($selected_column === '*') {
                    foreach ($row as $column => $value) {
                        echo "{$column}: {$value}<br/>";
                    }
                } else {
                    // sinon on affiche les colonnes selectionnees
                    echo "{$row[$selected_column]}<br/>";
                }
            }
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateRecord($table, $record, $filter)
    {
        try {
            $pdo = $this->connection->getConnection();

            $set_array = [];
            foreach ($record as $column => $value) {
                $set_array[] = "{$column} = :{$column}";
            }
            $set_clause   = implode(', ', $set_array);

            $filter_array = [];
            foreach ($filter as $column => $value) {
                $filter_array[] = "{$column} = :where_{$column}";
            }
            $filter_clause = implode(' AND ', $filter_array);

            $query = "UPDATE {$table} SET {$set_clause} WHERE {$filter_clause}";

            $stmt = $pdo->prepare($query);

            foreach ($record as $column => &$value) {
                $stmt->bindParam(":{$column}", $value);
            }

            foreach ($filter as $column => &$value) {
                $stmt->bindParam(":where_{$column}", $value);
            }
            $stmt->execute();

            echo "Record updated";
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteRecord($table, $filter)
    {
        try {
            $pdo = $this->connection->getConnection();

            $filter_array = [];
            foreach ($filter as $column => $value) {
                $filter_array[] = "{$column} = :{$column}";
            }
            $filter_clause = implode(' AND ', $filter_array);

            $query = "DELETE FROM {$table} WHERE {$filter_clause}";

            $stmt = $pdo->prepare($query);

            foreach ($filter as $column => &$value) {
                $stmt->bindParam(":{$column}", $value);
            }

            $stmt->execute();

            echo "Record deleted";
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}