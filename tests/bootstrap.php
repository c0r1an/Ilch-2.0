<?php
/**
 * Bootstrap file for the PHPUnit implementation.
 *
 * @author Jainta Martin
 * @package ilch_phpunit
 */

/*
 * Defining constants from the main ilch "index.php" modified for the tests.
 */
define('ACCESS', 1);
define('VERSION', '2.0');
define('APPLICATION_PATH', __DIR__.'/../application');
define('CONFIG_PATH', __DIR__.'/../');
define('BASE_URL', 'http://localhost/ilch');
define('STATIC_URL', BASE_URL);

/*
 * Initializing the autoloading for the application classes and for custom
 * PHPUnit Classes.
 */
require_once APPLICATION_PATH.'/libraries/ilch/Functions.php';
require_once APPLICATION_PATH.'/libraries/ilch/Loader.php';
spl_autoload_register
(
    function ($class)
    {
        /*
         * Simply replacing all underscores with slashes, routing on from the current
         * dir and appending the ".php" suffix to get the filepath.
         */
        $filepath = __DIR__.'/'.str_replace('_', '/', $class).'.php';

        if(is_file($filepath))
        {
            require_once $filepath;
        }
    }
);