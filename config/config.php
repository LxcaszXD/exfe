<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

/*
|--------------------------------------------------------------------------
| URL BASE
|--------------------------------------------------------------------------
| Local = localhost
| Produção = domínio automático Railway
*/

$base = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';

if($base == 'localhost'){
    define("BASE_URL", "http://localhost/exfe/public/");
}else{
    define("BASE_URL", "https://" . $base . "/");
}

/*
|--------------------------------------------------------------------------
| BANCO DE DADOS
|--------------------------------------------------------------------------
| Railway usa variáveis de ambiente
*/

define("DB_HOST", getenv("DB_HOST") ?: "localhost");
define("DB_NAME", getenv("DB_NAME") ?: "db_exfe");
define("DB_USER", getenv("DB_USER") ?: "root");
define("DB_PASS", getenv("DB_PASS") ?: "");

/*
|--------------------------------------------------------------------------
| EMAIL
|--------------------------------------------------------------------------
*/

define('EMAIL_HOST', getenv("EMAIL_HOST") ?: 'smtp.hostinger.com');
define('EMAIL_PORT', getenv("EMAIL_PORT") ?: '465');
define('EMAIL_USER', getenv("EMAIL_USER"));
define('EMAIL_PASS', getenv("EMAIL_PASS"));

/*
|--------------------------------------------------------------------------
| AUTOLOAD
|--------------------------------------------------------------------------
*/

spl_autoload_register(function ($classe){

    if(file_exists('../app/controllers/' . $classe .'.php')){
        require_once '../app/controllers/'. $classe .'.php';
    }

    if(file_exists('../app/models/'. $classe .'.php')){
        require_once '../app/models/'. $classe .'.php';
    }

    if(file_exists('../core/'. $classe .'.php')){
        require_once '../core/'. $classe .'.php';
    }

});