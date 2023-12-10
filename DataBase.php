<?php
namespace Credentials;
require_once 'autoloader.php';

class DataBase
{
    private $connection;

    public function __construct()
    {
        $this->connection = new Connection();
    }

    public function addRecord($table, $record)
    {
        try {
            $pdo = $this->connection->getConnection();

            $columns = implode(", ", array_keys($record));
            $placeholders = ":" . implode(", :", array_keys($record));

            $stmt = $pdo->prepare("INSERT INTO {$table} ({$columns}) VALUES ({$placeholders}) ");

            foreach ($record as $key => $value) {
                $stmt->bindValue(":{$key}", $value);
            }

            $stmt->execute();

            echo "Record created";
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

public function selectRecord($table, $filter)
{
    try {
        $pdo = $this->connection->getConnection();

        $selected_column = isset($filter['select_column']) ? $filter['select_column'] : '*';
        unset($filter['select_column']);

        $columns = implode(", ", array_keys($filter));

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
            echo "{$row[$selected_column]}<br/>";
        }
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

}