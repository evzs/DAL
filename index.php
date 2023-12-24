<?php
namespace Credentials;
require_once 'autoloader.php';


// selectionne toutes les colonnes du record avec le filtre (id) correspondant
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

// selectionne la ou les colonnes specifiees dans le tableau
try {
    $db = new DataBase();

    $table = 'test_table';
    $filter = [
        'id' => 1,
        'select_column' => ['id', 'test_column'],
    ];

    $db->selectRecord($table, $filter);
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}

// cree un nouveau record dans la ou les colonnes specifiees
try {
    $db = new DataBase();

    $table = 'test_table';

    $record = [
        'test_column' => 'hello',
        'column_test' => 'world'
    ];

    $db->addRecord($table, $record);

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}

// met a jour la valeur d'un record dans une colonne specifiee, avec le filtre (id) pour indiquer quel record doit etre mis a jour
try {
    $db = new DataBase();

    $table = 'test_table';

    $filter = [
        'id' => '5',
    ];

    $record = [
        'test_column' => 'update!',
    ];

    $db->updateRecord($table, $record, $filter);

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}

// supprime un record avec le filtre (id) correspondant
try {
    $db = new DataBase();

    $table = 'test_table';

    $filter = [
        'id' => '6',
    ];

    $db->deleteRecord($table, $filter);

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}




