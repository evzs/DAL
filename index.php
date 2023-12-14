<?php
namespace Credentials;
require_once 'autoloader.php';

try {
    $db = new DataBase();

    $table = 'test_table';
    $filter = [
        'id' => 1,
        'select_column' => '*',
    ];

    $db->selectRecord($table, $filter);
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}