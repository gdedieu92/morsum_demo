<?php

/* DEFAULT CONTROLLER */
define('DEFAULT_CONTROLLER', 'panel');

/* ENVIROMENT SI ES DEVELOPMENT OR PRDOUCCION */
define('ENVIRONMENT', 'development');

/* PROJECT URL */
define('URL', 'http://localhost/morsum_demo_recipes/');

/* ERROR SETTINGS */
switch (ENVIRONMENT) {
    case 'development':
        error_reporting(-1);
        ini_set('display_errors', 1);
        break;
    case 'production':
        ini_set('display_errors', 0);
        if (version_compare(PHP_VERSION, '5.3', '>=')) {
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
        } else {
            error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
        }
        break;
}

/* DB CONFIGURATION */
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'recipes_demo');
define('DB_USER', 'root');
define('DB_PASS', '');

/* EXPIRATION SESSION TIME */
define('EXPIRE_TIME', 14400);

/* CHARSET */
mb_internal_encoding("UTF-8");

/* TIMEZONE */
date_default_timezone_set('America/Argentina/Buenos_Aires');

/* CONTROLLERS */
define('C_PATH', ROOT . '/application/controllers/');

/* MODELS */
define('M_PATH', ROOT . '/application/models/');

/* VIEWS */
define('V_PATH', ROOT . '/application/views/');

/* CONSTANTS PATH */
define('IMAGES_RECIPES', ROOT . '/public/recipes/');
