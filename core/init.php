<?php

// START SESSION
session_start();


// CONFIG DEF
$GLOBALS['config'] = array(
    'mysql' => array(
        'host'=> '127.0.0.1',
        'username'=> 'root',
        'password' => '',
        'db' => 'oop_login'
    ),
    'remember'=> array(
        'cookie_name'=>'hash',
        'cookie_expiry' => 604800
    ),
    'session'=> array(
        'session_name'=>'user',
        'token_name' => 'token'
    )
);

// DISPLAY ERRORS
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



spl_autoload_register(function($class) {
    require_once 'classes/'. $class . '.php';
});

require_once 'functions/sanitize.php';


?>
