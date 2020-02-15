<?php
// Middleware for AJAX requests.

include_once 'utils/autoload.php';

$sClassName = $_REQUEST['class'];
$sAction = $_REQUEST['action'];
$sFile = $_SERVER['DOCUMENT_ROOT'] . '/Nexus/class/class.' . $sClassName . '.php';

$aResult = [];

// Simple router for AJAX requests.
if (isset($_REQUEST['class']) === false || file_exists($sFile) === false) {
    $aResult =    array(
        'result' => false,
        'msg'    => 'Invalid request.'
    );

    echo json_encode($aResult);
    exit;
}
$oClass = new $sClassName($_POST);
$aResult = $oClass->$sAction();

return $aResult;
