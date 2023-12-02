<?php
namespace Credentials;
require_once 'autoloader.php';

try {
    $connect = new Connection();
    $pdo = $connect->getConnection();
    echo "letsgooo";

    $stmt = $pdo->query("SELECT * FROM test_table");
    while ($row = $stmt->fetch()) {
        echo $row['test_column'] . "<br/>";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}