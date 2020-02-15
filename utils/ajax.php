<?php
include_once 'utils/autoload.php';

// Simple router for AJAX requests.
if (isset($_REQUEST['class']) === true) {
    echo json_encode(
        array(
            'result' => false,
            'msg'    => 'Invalid request'
        )
    );
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once('class/' . $_REQUEST['class']. '.php');
}