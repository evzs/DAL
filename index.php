<?php
namespace Credentials;
require_once 'autoloader.php';


try {
    $db = new DataBase();

    $table_name = 'test_table';
    $data = [
        'test_column' => 'test',
    ];

    $db->createRecord($table_name, $data);
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}