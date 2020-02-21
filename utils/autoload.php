<?php
spl_autoload_register('classAutoloader');

function classAutoloader($sClassName) {

    $sFile = $_SERVER['DOCUMENT_ROOT'] . '/Nexus/class/class.' . $sClassName . '.php';

    if (file_exists($sFile) === false) {
        return false;
    }

    include_once $sFile;
}
