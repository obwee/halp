<?php

/**
 * dbConnection
 * Class for establishing database connection.
 * @author Aries V. Macandili
 * @since 2020-02-13
 */
class dbConnection extends PDO
{
    private $sHost     = '';
    private $sDbName   = '';
    private $sUsername = '';
    private $sPassword = '';

    /**
     * dbConnection constructor.
     * This method is invoked/called automatically when class is instantiated.
     */
    public function __construct()
    {
        $this->sHost     = 'localhost';
        $this->sDbName   = 'nexus';
        $this->sUsername = 'root';
        $this->sPassword = '';

        try {
            $sDsn = 'mysql:host=' . $this->sHost . ';dbname=' . $this->sDbName . ';';
            $aOptions = array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            );
            parent::__construct($sDsn, $this->sUsername, $this->sPassword, $aOptions);
        } catch (PDOException $oException) {
            echo 'Connection failed: ' . $oException->getMessage();
        }
    }
}
