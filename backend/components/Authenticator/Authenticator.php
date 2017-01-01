<?php
/**
* Copyright (c) 2013 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

include_once 'components/Authenticator/interface/AuthenticatorInterface.php';
include_once 'components/Authenticator/interface/SessionHandlerInterface.php';
include_once 'components/Authenticator/interface/DatabaseHandlerInterface.php';
include_once 'components/Authenticator/interface/EncryptManagerInterface.php';

class Authenticator implements AuthenticatorInterface
{
    public function __construct(){}

    public function setSessionHandler(SessionHandlerInterface $sessionHandler)
    {
        $this->sessionHandler = $sessionHandler;
    }

    public function getSessionHandler()
    {
        return $this->sessionHandler;
    }

    public function setDBHandler(DatabaseHandlerInterface $dbh)
    {
        $this->dbh = $dbh;
    }

    public function getDBHandler()
    {
        return $this->dbh;
    }

    public function setEncryptor(EncryptorInterface $encryptor)
    {
        $this->encryptor = $encryptor;
    }

    public function getEncryptManager()
    {
        return $this->encryptor;
    }

    public function authenticate($userName, $password)
    {
        if( !$this->sessionHandler->get('authenticated') )
        {
            //DATAHANDLER
            $storedUser = $dbh->exec('select users.id,
                                        users.userName,
                                        users.password 
                                        from users 
                                        where users.userName = $userName')[0];

            //PASSWORD VERIFY
            $isAuthenticate = $this->encryptor->verify($password, $storedUser['password']);

            if( $isAuthenticate )
            {
                //SET SESSION DATA
                $this->sessionHandler->set('sessionUserName', $storedUser['userName']);
                $this->sessionHandler->set('sessionUserId', $storedUser['id']);
                $this->sessionHandler->set("authenticated", true);
            }
            else
            {
                $this->sessionHandler->set("authenticated", false);
            }  
        }
    }
}
?>