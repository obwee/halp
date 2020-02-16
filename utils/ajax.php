<?php
// Middleware for AJAX requests.

include_once 'utils/autoload.php';

$sClassName = $_REQUEST['class'];
$sAction = $_REQUEST['action'];
$sFile = $_SERVER['DOCUMENT_ROOT'] . '/Nexus/class/class.' . $sClassName . '.php';

$aResult =    array(
    'result' => false,
    'msg'    => 'Invalid request.'
);

// Check if class exists.
if (isset($_REQUEST['class']) === false || file_exists($sFile) === false) {
    // Return error message.
    echo json_encode($aResult);
    exit;
}

// Invoke the class.
$oClass = new $sClassName($_POST);

// Check if method exists.
if (method_exists($oClass, $sAction) === false) {
    // Return error message.
    echo json_encode($aResult);
    exit;

}
// Execute the method for the class.
$aResult = $oClass->$sAction();

return $aResult;
