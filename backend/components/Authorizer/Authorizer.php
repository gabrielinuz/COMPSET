<?php
/**
* Copyright (c) 2013 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

include_once 'components/Authorizer/interface/AuthorizerInterface.php';
include_once 'components/Authorizer/interface/AuthenticatorInterface.php';
include_once 'components/Authenticator/interface/SessionHandlerInterface.php';
include_once 'components/Authenticator/interface/DatabaseHandlerInterface.php';
include_once 'components/Authenticator/interface/ActionInterface.php';

class Authorizer implements AuthorizerInterface
{
    public function __construct(){}

    public function setAuthenticator(AuthenticatorInterface $authenticator)
    {
        $this->authenticator = $authenticator;
        setSessionHandler($this->authenticator->getSessionHandler);
        setDBHandler($this->authenticator->getDBHandler);
    }

    public function getAuthenticator()
    {
        return $this->authenticator;
    }

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

    public function authorize(ActionInterface $action)
    {
        if( !$this->sessionHandler->get('authenticated') )
        {
            if( $allowedRoles )
            {
                $this->sessionHandler->set("authorized", true);
            }
            else
            {
                $this->sessionHandler->set("authorized", false);
            }

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