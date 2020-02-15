<?php

class Register
{
    private $aParams;

    private $aRules = array();

    private $aData;

    public function __construct($aPostVariables)
    {
        $this->aParams = $aPostVariables;
    }

    public function registerStudent()
    {
        $this->changeKeyNames();
        $this->sanitizeInputs();
        die;
    }

    private function changeKeyNames()
    {
        foreach ($this->aParams as $sKey => $mValue) {
            $this->aData[$this->aKeys[$sKey]] = $mValue;
        }
    }

    private function sanitizeInputs()
    {
        $aKeys = array(
            'registrationFname'           => array(
                'sName'      => 'firstName',
                'iLength'    => strlen($this->aData['asfasfa']),
                'iMinLength' => 'firstName',
                'iMaxLength' => 'firstName',
                'oPattern'   => ''
            ),
            'registrationMname'           => array(
                'sName'      => 'firstName',
                'iLength'    => strlen($this->aData['asfasfa']),
                'iMinLength' => 'firstName',
                'iMaxLength' => 'firstName',
                'oPattern'   => ''
            ),
            'registrationLname'           => array(
                'sName'      => 'firstName',
                'iLength'    => strlen($this->aData['asfasfa']),
                'iMinLength' => 'firstName',
                'iMaxLength' => 'firstName',
                'oPattern'   => ''
            ),
            'registrationCompany'         => array(
                'sName'      => 'firstName',
                'iLength'    => strlen($this->aData['asfasfa']),
                'iMinLength' => 'firstName',
                'iMaxLength' => 'firstName',
                'oPattern'   => ''
            ),
            'registrationContactNum'      => array(
                'sName'      => 'firstName',
                'iLength'    => strlen($this->aData['asfasfa']),
                'iMinLength' => 'firstName',
                'iMaxLength' => 'firstName',
                'oPattern'   => ''
            ),
            'registrationEmail'           => array(
                'sName'      => 'firstName',
                'iLength'    => strlen($this->aData['asfasfa']),
                'iMinLength' => 'firstName',
                'iMaxLength' => 'firstName',
                'oPattern'   => ''
            ),
            'registrationUsername'        => array(
                'sName'      => 'firstName',
                'iLength'    => strlen($this->aData['asfasfa']),
                'iMinLength' => 'firstName',
                'iMaxLength' => 'firstName',
                'oPattern'   => ''
            ),
            'registrationPassword'        => array(
                'sName'      => 'firstName',
                'iLength'    => strlen($this->aData['asfasfa']),
                'iMinLength' => 'firstName',
                'iMaxLength' => 'firstName',
                'oPattern'   => ''
            ),
            'registrationConfirmPassword' => array(
                'sName'      => 'firstName',
                'iLength'    => strlen($this->aData['asfasfa']),
                'iMinLength' => 'firstName',
                'iMaxLength' => 'firstName',
                'oPattern'   => ''
            )
        );
    
    }
}
