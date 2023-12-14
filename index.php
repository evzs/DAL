<?php
namespace Credentials;
require_once 'autoloader.php';

try {
    $db = new DataBase();

    $table = 'test_table';

    $record = [
        'test_column' => 'hello'
    ];

    $db->addRecord($table, $record);

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
