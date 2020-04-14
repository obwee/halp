<?php

define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('DS', DIRECTORY_SEPARATOR);
define('PAYMENT_DIR', ROOT . DS . 'Nexus' . DS . 'dashboard' . DS . 'payments' . DS);
define('SERVER_NAME', $_SERVER['SERVER_NAME'] . DS . 'Nexus');

function dateNow() {
    return date('Y-m-d H:i:s');
}

spl_autoload_register('classAutoloader');

function classAutoloader($sClassName) {

    $aFiles = array(
        $_SERVER['DOCUMENT_ROOT'] . '/Nexus/class/Libraries/class.' . $sClassName . '.php',
        $_SERVER['DOCUMENT_ROOT'] . '/Nexus/class/Controllers/class.' . $sClassName . '.php',
        $_SERVER['DOCUMENT_ROOT'] . '/Nexus/class/Models/class.' . $sClassName . '.php'
    );

    foreach ($aFiles as $sFile) {
        if (file_exists($sFile) === true) {
            include_once $sFile;
        }
    }
    
}
