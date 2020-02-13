<?php

class dbConnection extends PDO
{
    private $sHost = 'localhost';
    private $sDbName = 'nexus';
    private $sUsername = 'root';
    private $sPassword = '';

    public function __construct()
    {
        try {
            $sDsn = 'mysql:host=' . $this->sHost . ';dbname=' . $this->sDbName . ';';
            $aOptions = array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            );
            parent::__construct($sDsn, $this->sUsername, $this->sPassword, $aOptions);
        } catch (PDOException $oException) {
            echo 'Connection failed: ' . $oException->getMessage();
        }
    }
}
