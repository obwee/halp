<?php
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
