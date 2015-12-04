<?php

function my_autoloader($class)
{
    if (preg_match('/\\\/', $class)) {
        $class = implode('/', explode('\\', $class));
    }

    $root = implode('/', explode('\\', dirname(__FILE__))) . '/';

    $path = $root . 'lib/' . $class . '.php';
//    echo $path.'<br>';
    if (file_exists($path))
        require_once $path;
    else throw new Exception($class . ' not exist');
}

spl_autoload_register('my_autoloader');

$root = implode('/', explode('\\', dirname(__FILE__)));

$doc = new \tms\ApiDoc\tmsApiDoc($root . '/src/api/');
