<?php
namespace Credentials;
require_once 'autoloader.php';


// CREATE
$new_data = [
    'test_column' => 'test',
];

try {
    $connect = new Connection();
    $pdo = $connect->getConnection();

    $stmt = $pdo->prepare("INSERT INTO test_table (test_column) VALUES (:test_column)");

    $stmt->bindParam(':test_column', $new_data['test_column'], \PDO::PARAM_STR);

    $stmt->execute();

    echo "Record created";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}

// READ
try {
    $connect = new Connection();
    $pdo = $connect->getConnection();

    $id = 1;
    $stmt = $pdo->prepare("SELECT test_column FROM test_table WHERE id = :id");

    $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

    $stmt->execute();

    while ($row = $stmt->fetch()) {
        echo $row['test_column'] . "<br/>";
    }

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}

// UPDATE
$updated_data = [
    'id' => 1,
    'test_column' => 'Hello, Eva!',
];

try {
    $connect = new Connection();
    $pdo = $connect->getConnection();

    $stmt = $pdo->prepare("UPDATE test_table SET test_column = :test_column WHERE id = :id");

    $stmt->bindParam(':test_column', $updated_data['test_column'], \PDO::PARAM_STR);
    $stmt->bindParam(':id', $updated_data['id'], \PDO::PARAM_INT);

    $stmt->execute();

    echo "Record updated";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}

// DELETE
$record_to_delete = 2;

try {
    $connect = new Connection();
    $pdo = $connect->getConnection();

    $stmt = $pdo->prepare("DELETE FROM test_table WHERE id = :id");
    $stmt->bindParam(':id', $record_to_delete, \PDO::PARAM_INT);
    $stmt->execute();

    echo "Record deleted";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}