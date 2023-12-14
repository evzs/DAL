<?php
function autoloader($class_name) {
    $root_namespace = 'Credentials';

    if (str_starts_with($class_name, $root_namespace)) {
        $class_name = substr($class_name, strlen($root_namespace));

        $class_name = ltrim($class_name, '\\');
        $class_file = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class_name) . '.php';

        if (file_exists($class_file)) {
            require_once $class_file;
        }
    }
}

spl_autoload_register('autoloader');
//function autoloader($class_name) {
//    $class_name = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);
//    $class_file = __DIR__ . DIRECTORY_SEPARATOR . $class_name . '.php';
//
//    if (file_exists($class_file)) {
//        require_once $class_file;
//    }
//}
//
//spl_autoload_register('autoloader');
