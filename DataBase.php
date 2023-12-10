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

    public function createRecord($table_name, $data)
    {
        try {
            $pdo = $this->connection->getConnection();

            $columns = implode(", ", array_keys($data));
            $placeholders = ":" . implode(", :", array_keys($data));

            $stmt = $pdo->prepare("INSERT INTO {$table_name} ({$columns}) VALUES ({$placeholders}) ");

            foreach ($data as $key => $value) {
                $stmt->bindValue(":{$key}", $value);
            }

            $stmt->execute();

            echo "Record created";
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}