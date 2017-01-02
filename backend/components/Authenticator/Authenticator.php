<?php
/**
* Copyright (c) 2013-2016 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'components/Authenticator/interface/AuthenticatorInterface.php';
// require_once 'components/Authenticator/interface/SessionHandlerInterface.php';
// require_once 'components/Authenticator/interface/DatabaseHandlerInterface.php';
// require_once 'components/Authenticator/interface/EncryptorInterface.php';

class Authenticator implements AuthenticatorInterface
{
    public function setSessionHandler(CSessionHandlerInterface $sessionHandler)
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

    public function authenticate($userName, $password)
    {
        // if( !$this->sessionHandler->get('authenticated') )
        // {
            //DATAHANDLER
            $storedUser = $this->dbh->exec('select users.id,
                                        users.username,
                                        users.password 
                                        from users 
                                        where users.username = ?', $userName)[0];

            //PASSWORD VERIFY
            $isAuthenticate = $this->encryptor->verify($password, $storedUser['password']);

            if( $isAuthenticate )
            {
                //SET SESSION DATA
                $this->sessionHandler->set('sessionUserName', $storedUser['username']);
                $this->sessionHandler->set('sessionUserId', $storedUser['id']);
                $this->sessionHandler->set("authenticated", true);
            }
            else
            {
                $this->sessionHandler->set("authenticated", false);
            }  
        // }
        return $this->sessionHandler->get("authenticated");
    }
}
?>